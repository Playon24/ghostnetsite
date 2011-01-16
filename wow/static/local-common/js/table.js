/**
 * Primary table utility that handles the sorting, filtering and pagination of a table and its rows.
 *
 * @copyright   2010, Blizzard Entertainment, Inc
 * @class       Table
 * @requires    Core
 */
var Table = Class.extend({

	/**
	 * jQuery objects for specific elements.
	 */
	table: null,
	query: '',
	controls: [],
	headers: [],
	links: [],
	pages: [],
	none: null,

	/**
	 * Configuration.
	 */
	config: {
		// sorting
		sorting: true,
		column: false,
		method: 'default',
		type: 'asc',
		
		// paging
		paging: false,
		page: 1,
		results: 50,
		totalPages: null,
		totalResults: null,
		pageCount: 10,

		// filtering
		filtering: true,

		// misc
		articles: [],
		cache: false
	},

	/**
	 * Pagination overwrites.
	 */
	pager: {
		page: 1,
		totalPages: null,
		totalResults: null
	},

	/**
	 * Filter rules and mapping.
	 */
	filters: {
		map: {},
		rules: []
	},

	/**
	 * A cache of all the rows, disconnected from the DOM.
	 */
	source: [],
	cached: [],

	/**
	 * Detect if the table exists, if so apply config and detach nodes.
	 *
	 * @param table
	 * @param config
	 */
	init: function(table, config) {
		this.query = table;
		
		table = $(table);

		if (table.length) {
			if (table[0].tagName !== 'table')
				table = table.find('table');

			this.table = (table.length) ? table : null;
		}

		if (this.table) {
			// Merge configuration
			this.config = $.extend(this.config, config);

			// Setup the class
			this.setup();

			// Should we cache?
			if (this.config.cache) {
				this.cache();
				this.process();
			}
		}
	},

	/**
	 * Once DOM is ready, detach nodes into the class and cache results.
	 *
	 * @param recache
	 */
	cache: function(recache) {
		if (this.source.length && !recache)
			return;
		
		var rows = this.table.find('tbody tr'),
			row = null,
			data = [],
			source = [],
			columns = [],
			column = null,
			i,
			c;

		for (i = 0; row = rows[i]; i++) {
			row = $(row);

			if (row.hasClass('no-results')) {
				this.none = row.removeClass('row-hidden').show().detach();
				continue;
			}

			columns = row[0].getElementsByTagName('td');
			data = [];

			for (c = 0; column = columns[c]; c++) {
				data[c] = this._getText(column, false, this.articles);
			}

			source.push([
				data,
				row.detach()
			]);
		}

		this.source = source;
	},

	/**
	 * Filter the rows using various techniques.
	 *
	 * @param action	accepts: column, row, class
	 * @param index		column index or key
	 * @param value		value to test against
	 * @param type		column types: default, range, exact, greaterThan, lessThan, startsWith, endsWith
	 */
	filter: function(action, index, value, type) {
		if (!this.config.filtering)
			return;

		// Cache the rows
		this.cache();

		// Map filter rule
		this._mapFilter(action +'-'+ index, value, {
			filter: action,
			column: index,
			match: this._setNeedle(value),
			type: type || ''
		});

		// Reset page back to 1
		this.pager.page = 1;

		// Process rows
		this.cached = [];
		this.process(true);
	},

	/**
	 * Setup batch filters and run the filter process a single time.
	 *
	 * @param rules
	 */
	filterBatch: function(rules) {
		if (!this.config.filtering)
			return;

		// Map filter rules
		var data, process = false;

		if (rules.rows && rules.rows.length > 0) {
			for (var r = 0; data = rules.rows[r]; ++r) {
				this._mapFilter('row-'+ data[0], data[1], {
					filter: 'row',
					column: data[0],
					match: _setNeedle(data[1])
				});
			}

			process = true;
		}

		if (rules.classes && rules.classes.length > 0) {
			for (var c = 0; data = rules.classes[c]; ++c) {
				this._mapFilter('class-'+ data[0], data[1], {
					filter: 'class',
					column: data[0],
					match: data[1]
				});
			}

			process = true;
		}

		if (rules.columns && rules.columns.length > 0) {
			for (var i = 0; data = rules.columns[i]; ++i) {
				this._mapFilter('column-'+ data[0], data[1], {
					filter: 'column',
					column: data[0],
					match: this._setNeedle(data[1]),
					type: data[2] || ''
				});
			}

			process = true;
		}

		if (process) {
			// Cache the rows
			this.cache();

			// Reset page back to 1
			this.pager.page = 1;

			// Process rows
			this.cached = [];
			this.process(true);
		}
	},

	/**
	 * Paginate a group of rows.
	 *
	 * @param page
	 */
	paginate: function(page) {
		if (!this.config.paging)
			return;

		// Cache the results
		this.cache();

		// Set the new page
		this.pager.page = page;

		// Process rows
		this.process();

		// Scroll to top
		Core.scrollTo(this.table);
	},

	/**
	 * Run all the processes and reinsert rows that validate.
	 *
	 * @param filtered
	 */
	process: function(filtered) {
		var source = (this.cached.length) ? this.cached : this.source,
			i = source.length - 1,
			l = i,
			k;

		// Loop over data
		if (i >= 0) {
			if (this.none !== null)
				this.none.detach();

			var fragment = document.createDocumentFragment(),
				display = Core.isIE() ? 'block' : 'table-row',
				config = this.config,
				cache = [],
				count = 0,
				row = null,
				add = false,
				no = 1;

			// Paging variables
			if (config.paging) {
				var page = this.pager.page,
					start = (config.results * (page - 1)),
					pageCount = 0;
			}

			do {
				k = l - i;

				if (source[k]) {
					row = source[k][1].clone();
					add = true;

					// Filter down the rows
					if (config.filtering) {
						if (!this._processFilters(row, source[k][0])) {
							continue;
						}
					}

					// Determine which pages to display
					if (config.paging) {
						if (count >= start && pageCount < config.results) {
							pageCount++;
						} else {
							add = false;
						}
					}

					// Add the rows
					if (add) {
						row.css('display', display)
							.removeClass('row1 row2')
							.addClass('row'+ ((no % 2) ? 1 : 2));

						fragment.appendChild(row[0]);
					}

					// Save cached data
					cache.push([
						source[k][0],
						row
					]);

					count++;
					no++;
				}
			} while (i--);

			// No results
			if (count <= 0 && this.none !== null)
				fragment.appendChild(this.none[0]);

			// Update paging
			if (config.paging) {
				this.pager.totalResults = count;
				this.pager.totalPages = Math.ceil(count / config.results);

				if (filtered)
					this._buildPagination();

				this._updateResults(page);
				this._updatePagination(page);
			}

			// Append document fragment
			this.table.find('tbody').html(fragment);
			this.cached = cache;

		// No rows? Show no results
		} else {
			if (this.none !== null)
				this.table.find('tbody').append(this.none);
		}
	},

	/**
	 * Reset the class back to defaults, but do not clear the cache.
	 */
	reset: function() {
		var config = this.config;
		this.cached = [];

		// Paging
		this.pager = {
			page: 1,
			totalPages: null,
			totalResults: null
		};

		// Filtering
		this.filters = {
			map: {},
			rules: []
		};

		// Sorting
		if (config.column !== false)
			this.sort(config.column, config.method, config.type);

		// Process rows
		this.process(true);
	},

	/**
	 * Bind the sorting event handlers, setup pagination config, prepare filters, do magic.
	 */
	setup: function() {
		var config = this.config;

		// Sorting
		if (config.sorting) {
			this.headers = this.table.find('thead th');
			this.links = this.headers.find('a.sort-link');

			if (this.links.length) {
				this.links.unbind().bind('click', { table: this }, function(e) {
					e.stopPropagation();

					var node = $(this),
						method = 'default',
						table = e.data.table;

					if (node.hasClass('numeric'))
						method = 'numeric';
					else if (node.hasClass('date'))
						method = 'date';

					table.sort(table.headers.index(node.parent('th')), method);

					return false;
				});
			}

			// Run the default sort
			if (config.column !== false)
				this.sort(config.column, config.method, config.type);
		}

		// Paging
		if (config.paging) {
			this.controls = $('.table-options');

			if (config.totalResults > config.results) {
				if (!config.totalPages)
					config.totalPages = Math.ceil(config.totalResults / config.results);

				if (!config.pageCount)
					config.pageCount = 10;

				this._buildPagination();

				if (config.page > 1)
					this.paginate(config.page);
				else
					this._updatePagination(1);
			}
		}
	},

	/**
	 * Sort the rows based on a column.
	 *
	 * @param column
	 * @param method	accepts: default, numeric
	 * @param type		accepts: asc, desc, reverse
	 */
	sort: function(column, method, type) {
		if (!this.config.sorting || typeof column === 'undefined' || typeof method === 'undefined')
			return;

		// Cache the rows
		this.cache();

		if (typeof type === 'undefined')
			type = 'asc';

		// Set the active link tab in the headers
		if (column >= 0) {
			var tab = this._activeHeader(column);

			if (tab.is('.up, .down')) {
				if (tab.hasClass('up'))
					tab.removeClass('up').addClass('down');
				else
					tab.removeClass('down').addClass('up');

				type = 'reverse';
			} else {
				tab.addClass((type === 'asc') ? 'up' : 'down');
			}
		}

		// Avoid descending sort since reverse() is faster
		var data = (this.cached.length) ? this.cached : this.source;

		if (type !== 'reverse') {

			// Numeric
			if (method === 'numeric') {
				data.sort(function(a, b) {
					var x = a[0][column],
						y = b[0][column];

					return parseFloat(x) - parseFloat(y);
				});

			// Date
			} else if (method == 'date') {
				var dateParse = Date.parse;

				data.sort(function(a, b) {
					var x = dateParse(a[0][column]),
						y = dateParse(b[0][column]);

					return parseFloat(x) - parseFloat(y);
				});

			// Alphabetic
			} else {
				data.sort(function(a, b) {
					var x = a[0][column],
						y = b[0][column];

					return ((x < y) ? -1 : ((x > y) ? 1 : 0));
				});
			}

			if (type === 'desc')
				data.reverse();

		} else if (type === 'reverse') {
			data.reverse();
		}

		// Process rows
		this.process();
	},

	/**
	 * Find the active column header.
	 *
	 * @param column
	 */
	_activeHeader: function(column) {
		this.headers.not(':eq('+ column +')').find('.arrow').attr('class', 'arrow');

		return this.headers.eq(column).find('.arrow');
	},

	/**
	 * Build the paging link.
	 *
	 * @param text
	 * @param page
	 */
	_buildLink: function(text, page) {
		var li = $('<li/>').hide();

		$('<a/>', {
			text: text,
			href: '#page='+ page
		})
		.bind('click', { table: this }, function(e) {
			e.preventDefault();
			e.data.table.paginate(page);

			if (typeof Filter !== 'undefined') {
				Filter.addParam('page', page);
				Filter.applyQuery();
			}

			return false;
		})
		.appendTo(li);

		return li;
	},

	/**
	 * Create the pagination links and save to a variable.
	 *
	 * @param resetData
	 */
	_buildPagination: function() {
		if (!this.controls.length)
			return;

		var ul = this.controls.find('.ui-pagination'),
			total = this.config.totalPages;

		if (this.pager.totalPages !== null)
			total = this.pager.totalPages;

		// Builds items
		ul.empty();

		if (total > 1) {
			var li;

			for (var i = 1; i <= total; ++i) {
				li = this._buildLink(i, i);
				li.appendTo(ul);
			}

			// Build expanders
			if (total > this.config.pageCount) {
				var first = this._buildLink(Msg.grammar.first, 1),
					last = this._buildLink(Msg.grammar.last, total);

				first.addClass('first-item').prependTo(ul);
				last.addClass('last-item').appendTo(ul);
			}
		}

		// Save reference
		this.pages = $('.table-options .ui-pagination');
	},

	/**
	 * Extracts the text from the cell or data attribute and removes articles.
	 *
	 * @param cell
	 * @param returnText
	 * @param articles
	 */
	_getText: function(cell, returnText, articles) {
		if (typeof cell === 'undefined')
			return '';

		cell = $(cell);
		articles = articles || [];

		var text = (!cell.data('raw')) ? cell.text() : cell.data('raw').toString();
			text = text.trim().toLowerCase();

		if (articles.length === 0 || returnText)
			return text;

		for (var i = 0, article; article = articles[i]; i++) {
			if (text.indexOf(article +' ') === 0)
				text = text.replace(new RegExp('^'+ article +' '), '');
		}

		return text;
	},

	/**
	 * Detect if the string contains a character.
	 *
	 * @param needle
	 * @param haystack
	 */
	_matches: function(needle, haystack) {
		if (typeof haystack === 'number') {
			return (needle == haystack);

		} else if (typeof needle === 'string') {
			return (haystack.indexOf(needle) >= 0);

		} else {
			var valid = true;

			for (var i = 0, test; test = needle[i]; ++i) {
				if (haystack.indexOf(test) == -1) {
					valid = false;
					break;
				}
			}

			return valid;
		}
	},

	/**
	 * Add or remove a mapping filter.
	 *
	 * @param key
	 * @param value
	 * @param filter
	 */
	_mapFilter: function(key, value, filter) {
		var map = this.filters.map,
			rules = this.filters.rules;

		if (value === "") {
			delete rules[map[key]];
			delete map[key];

		} else {
			if (map[key]) {
				rules[map[key]] = filter;
			} else {
				map[key] = rules.length.toString();
				rules[rules.length] = filter;
			}
		}
	},

	/**
	 * Run the current filters on the row.
	 * Returns true if the filter has passed.
	 *
	 * @param row
	 * @param columns
	 * @return boolean
	 */
	_processFilters: function(row, columns) {
		var filters = this.filters.rules,
			length = filters.length,
			pass = true,
			test,
			text;

		for (var i = 0; i < length; i++) {
			test = filters[i];

			if (!test)
				continue;

			// Row
			if (test.filter === 'row' && !this._matches(test.match, this._getText(row))) {
				pass = false;

			// Class
			} else if (test.filter === 'class' && !row.hasClass(test.match)) {
				pass = false;

			// Column
			} else if (test.filter === 'column') {
				text = columns[test.column];

				switch (test.type) {
					default:
						pass = this._matches(test.match, text);
					break;
					case 'equals':
						pass = (test.match == text);
					break;
					case 'notEquals':
						pass = (test.match != text);
					break;
					case 'exact':
						pass = (test.match === text);
					break;
					case 'range':
						pass = (parseInt(text) >= test.match[0] && parseInt(text) <= test.match[1]);
					break;
					case 'greaterThan':
						pass = (parseInt(text) > test.match);
					break;
					case 'greaterThanEquals':
						pass = (parseInt(text) >= test.match);
					break;
					case 'lessThan':
						pass = (parseInt(text) < test.match);
					break;
					case 'lessThanEquals':
						pass = (parseInt(text) <= test.match);
					break;
					case 'startsWith':
						pass = (text.substr(0, test.match.length) === test.match);
					break;
					case 'endsWith':
						pass = (text.substr(-test.match.length) === test.match);
					break;
				}
			}

			if (pass === false)
				break;
		}

		return pass;
	},

	/**
	 * Parse the needle before matching.
	 *
	 * @param needle
	 */
	_setNeedle: function(needle) {
		if (typeof needle === 'undefined')
			return "";
		else if (typeof needle !== 'string')
			return needle;

		needle = needle.trim().toLowerCase();

		if (needle.indexOf(' ') >= 0 && needle !== "")
			needle = needle.replace(/\s+/g, ' ').split(' ');

		return needle;
	},

	/**
	 * Update the number for currently viewed results.
	 *
	 * @param page
	 */
	_updateResults: function(page) {
		if (!this.controls.length)
			return;

		var total = this.config.totalResults,
			start = (1 + (this.config.results * (page - 1))),
			end = (start - 1) + this.config.results;

		if (this.pager.totalResults !== null)
			total = this.pager.totalResults;

		if (end > total)
			end = total;

		if (start <= 0)
			start = 1;
		else if (total <= 0)
			start = 0;

		this.controls
			.find('.results-start').html(start).end()
			.find('.results-end').html(end).end()
			.find('.results-total').html(total).end();
	},

	/**
	 * Update the pagination links to the currently active.
	 * Also truncate surrounding links.
	 *
	 * @param page
	 */
	_updatePagination: function(page) {
		if (!this.pages.length)
			return;

		var config = this.config,
			half = Math.round(config.pageCount / 2),
			display = 'inline-block';

		this.pages.each(function() {
			var li = $(this).find('li'),
				total = li.length,
				index = page;

			if (total <= 0)
				return;
			else if (total <= config.pageCount)
				index--;

			// Hide all items
			li.removeClass('current');

			// Set active
			li.eq(index).addClass('current');

			if (total > config.pageCount) {
				total = total - 2;
				li.hide();

				// End
				if (page >= (total - half)) {
					li.slice(-config.pageCount).not('.last-item').css('display', display);
					li.slice(0, 1).css('display', display);

				// Middle
				} else if (page > (half + 1) && page < (total - half)) {
					li.slice((page - half) + 1, (page + half)).css('display', display);
					li.slice(0, 1).css('display', display);
					li.slice(-1).css('display', display);

				// Start
				} else {
					li.slice(1, config.pageCount).css('display', display);
					li.slice(-1).css('display', display);
				}
			} else {
				li.css('display', display);
			}
		});
	}

});
