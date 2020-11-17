/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011–2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
!(function(a) {
    function f(a, b) {
        if (!(a.originalEvent.touches.length > 1)) {
            a.preventDefault();
            var c = a.originalEvent.changedTouches[0],
                d = document.createEvent("MouseEvents");
            d.initMouseEvent(
                b,
                !0,
                !0,
                window,
                1,
                c.screenX,
                c.screenY,
                c.clientX,
                c.clientY,
                !1,
                !1,
                !1,
                !1,
                0,
                null
            ),
                a.target.dispatchEvent(d);
        }
    }
    if (((a.support.touch = "ontouchend" in document), a.support.touch)) {
        var e,
            b = a.ui.mouse.prototype,
            c = b._mouseInit,
            d = b._mouseDestroy;
        (b._touchStart = function(a) {
            var b = this;
            !e &&
                b._mouseCapture(a.originalEvent.changedTouches[0]) &&
                ((e = !0),
                (b._touchMoved = !1),
                f(a, "mouseover"),
                f(a, "mousemove"),
                f(a, "mousedown"));
        }),
            (b._touchMove = function(a) {
                e && ((this._touchMoved = !0), f(a, "mousemove"));
            }),
            (b._touchEnd = function(a) {
                e &&
                    (f(a, "mouseup"),
                    f(a, "mouseout"),
                    this._touchMoved || f(a, "click"),
                    (e = !1));
            }),
            (b._mouseInit = function() {
                var b = this;
                b.element.bind({
                    touchstart: a.proxy(b, "_touchStart"),
                    touchmove: a.proxy(b, "_touchMove"),
                    touchend: a.proxy(b, "_touchEnd")
                }),
                    c.call(b);
            }),
            (b._mouseDestroy = function() {
                var b = this;
                b.element.unbind({
                    touchstart: a.proxy(b, "_touchStart"),
                    touchmove: a.proxy(b, "_touchMove"),
                    touchend: a.proxy(b, "_touchEnd")
                }),
                    d.call(b);
            });
    }
})(jQuery);
/**
 * jPList - jQuery Data Grid Controls 5.1.355 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var a = function(c, b) {
            var d, a;
            c &&
                c.controller &&
                c.controller.collection &&
                ((d = c.controller.collection.dataitems.length),
                jQuery.isNumeric(b.index) &&
                    0 <= b.index &&
                    b.index <= c.controller.collection.dataitems.length &&
                    (d = Number(b.index)),
                b.$item &&
                    c.controller.collection.addDataItem(
                        b.$item,
                        c.controller.collection.paths,
                        d
                    ),
                b.$items &&
                    ((a = b.$items),
                    jQuery.isArray(b.$items) &&
                        (a = jQuery(b.$items).map(function() {
                            return this.toArray();
                        })),
                    c.controller.collection.addDataItems(
                        a,
                        c.controller.collection.paths,
                        d
                    )),
                c.observer.trigger(c.observer.events.unknownStatusesChanged, [
                    !1
                ]));
        },
        d = function(c, b) {
            var d;
            c &&
                c.controller &&
                c.controller.collection &&
                (b.$item &&
                    (c.controller.collection.delDataitem(b.$item),
                    b.$item.remove()),
                b.$items &&
                    ((d = b.$items),
                    jQuery.isArray(b.$items) &&
                        (d = jQuery(b.$items).map(function() {
                            return this.toArray();
                        })),
                    c.controller.collection.delDataitems(d),
                    d.remove()),
                c.observer.trigger(c.observer.events.unknownStatusesChanged, [
                    !1
                ]));
        },
        b = function(c, b, f) {
            switch (b) {
                case "add":
                    a(c, f);
                    break;
                case "del":
                    d(c, f);
                    break;
                case "getDataItems":
                    b = null;
                    if (c.options && c.options.dataSource)
                        switch (c.options.dataSource.type) {
                            case "html":
                                c.controller &&
                                    c.controller.collection &&
                                    (b = c.controller.collection.dataitems);
                                break;
                            case "server":
                                c.controller &&
                                    c.controller.model &&
                                    c.controller.model.dataItem &&
                                    (b = c.controller.model.dataItem);
                        }
                    return b;
            }
        },
        c = function(c) {
            c.observer.on(c.observer.events.knownStatusesChanged, function(
                b,
                d
            ) {
                c.controller.renderStatuses(d);
            });
            c.observer.on(c.observer.events.statusesAppliedToList, function(
                b,
                d,
                a
            ) {
                jQuery.fn.jplist.info(
                    c.options,
                    "panel statusesAppliedToList -> setControlsStatuses: ",
                    a
                );
                c.panel.setStatuses(a);
                jQuery.fn.jplist.dal.services.DeepLinksService.updateUrlPerControls(
                    c.options,
                    c.panel.getDeepLinksURLPerControls()
                );
            });
            c.observer.on(c.observer.events.unknownStatusesChanged, function(
                b,
                d
            ) {
                jQuery.fn.jplist.info(
                    c.options,
                    "panel statusesChanged, isDefault: ",
                    d
                );
                c.panel.unknownStatusesChanged(d);
            });
            c.$root.find(c.options.iosBtnPath).on("click", function() {
                jQuery(this)
                    .next(c.options.panelPath)
                    .toggleClass("jplist-ios-show");
            });
            c.observer.on(c.observer.events.statusChanged, function(b, d) {
                jQuery.fn.jplist.info(c.options, "panel statusChanged: ", d);
                c.history.addStatus(d);
                c.panel.mergeStatuses(d);
            });
            c.observer.on(
                c.observer.events.statusesChangedByDeepLinks,
                function(b, d, a) {
                    c.panel.statusesChangedByDeepLinks(d, a);
                }
            );
        },
        f = function(b, d) {
            var a = { observer: null, panel: null, controller: null, $root: d };
            a.options = jQuery.extend(
                !0,
                {
                    debug: !1,
                    command: "init",
                    commandData: {},
                    itemsBox: ".list",
                    itemPath: ".list-item",
                    panelPath: ".panel",
                    noResults: ".jplist-no-results",
                    redrawCallback: "",
                    iosBtnPath: ".jplist-ios-button",
                    animateToTop: "html, body",
                    animateToTopDuration: 0,
                    effect: "",
                    duration: 300,
                    fps: 24,
                    storage: "",
                    storageName: "jplist",
                    cookiesExpiration: -1,
                    deepLinking: !1,
                    hashStart: "#",
                    delimiter0: ":",
                    delimiter1: "|",
                    delimiter2: "~",
                    delimiter3: "!",
                    historyLength: 10,
                    dataSource: {
                        type: "html",
                        server: {
                            ajax: {
                                url: "server.php",
                                dataType: "html",
                                type: "POST"
                            },
                            serverOkCallback: null,
                            serverErrorCallback: null
                        },
                        render: null
                    }
                },
                b
            );
            a.observer = new jQuery.fn.jplist.app.events.PubSub(
                a.$root,
                a.options
            );
            a.history = new jQuery.fn.jplist.app.History(
                a.$root,
                a.options,
                a.observer
            );
            a.panel = new jQuery.fn.jplist.ui.panel.controllers.PanelController(
                d,
                a.options,
                a.history,
                a.observer
            );
            a.options.dataSource = a.options.dataSource || {};
            a.options.dataSource.type = a.options.dataSource.type || "html";
            jQuery.fn.jplist.info(
                a.options,
                "Data Source Type: ",
                a.options.dataSource.type
            );
            switch (a.options.dataSource.type) {
                case "html":
                    a.controller = new jQuery.fn.jplist.ui.list.controllers.DOMController(
                        a.$root,
                        a.options,
                        a.observer,
                        a.panel,
                        a.history
                    );
                    break;
                case "server":
                    jQuery.fn.jplist.info(
                        a.options,
                        "Data Source: ",
                        a.options.dataSource
                    ),
                        (a.controller = new jQuery.fn.jplist.ui.list.controllers.ServerController(
                            a.$root,
                            a.options,
                            a.observer,
                            a.panel,
                            a.history
                        ));
            }
            c(a);
            a.options.deepLinking
                ? (jQuery.fn.jplist.info(a.options, "Deep linking enabled", ""),
                  a.panel.setStatusesByDeepLink())
                : a.panel.setStatusesFromStorage();
            a.observer.trigger(a.observer.events.init, []);
            return jQuery.extend(this, a);
        };
    jQuery.fn.jplist = function(c) {
        if (c.command && "init" !== c.command) {
            var a;
            if ((a = this.data("jplist")))
                return b(a, c.command, c.commandData);
        } else
            return this.each(function() {
                var b,
                    a = jQuery(this);
                b = new f(c, a);
                a.data("jplist", b);
            });
    };
})();
jQuery.fn.jplist.controlTypes = {};
jQuery.fn.jplist.itemControlTypes = {};
jQuery.fn.jplist.settings = {};
jQuery.fn.jplist.app = jQuery.fn.jplist.app || {};
jQuery.fn.jplist.app.services = jQuery.fn.jplist.app.services || {};
jQuery.fn.jplist.app.services.DTOMapperService =
    jQuery.fn.jplist.app.services.DTOMapperService || {};
jQuery.fn.jplist.app.dto = jQuery.fn.jplist.app.dto || {};
jQuery.fn.jplist.app.events = jQuery.fn.jplist.app.events || {};
jQuery.fn.jplist.domain = jQuery.fn.jplist.domain || {};
jQuery.fn.jplist.domain.dom = jQuery.fn.jplist.domain.dom || {};
jQuery.fn.jplist.domain.dom.models = jQuery.fn.jplist.domain.dom.models || {};
jQuery.fn.jplist.domain.dom.collections =
    jQuery.fn.jplist.domain.dom.collections || {};
jQuery.fn.jplist.domain.dom.services =
    jQuery.fn.jplist.domain.dom.services || {};
jQuery.fn.jplist.domain.dom.services.FiltersService =
    jQuery.fn.jplist.domain.dom.services.FiltersService || {};
jQuery.fn.jplist.domain.dom.services.SortService =
    jQuery.fn.jplist.domain.dom.services.SortService || {};
jQuery.fn.jplist.domain.dom.services.pagination =
    jQuery.fn.jplist.domain.dom.services.pagination || {};
jQuery.fn.jplist.domain.server = jQuery.fn.jplist.domain.server || {};
jQuery.fn.jplist.domain.server.models =
    jQuery.fn.jplist.domain.server.models || {};
jQuery.fn.jplist.domain.deeplinks = jQuery.fn.jplist.domain.deeplinks || {};
jQuery.fn.jplist.domain.deeplinks.services =
    jQuery.fn.jplist.domain.deeplinks.services || {};
jQuery.fn.jplist.dal = jQuery.fn.jplist.dal || {};
jQuery.fn.jplist.dal.services = jQuery.fn.jplist.dal.services || {};
jQuery.fn.jplist.ui = jQuery.fn.jplist.ui || {};
jQuery.fn.jplist.ui.list = jQuery.fn.jplist.ui.list || {};
jQuery.fn.jplist.ui.list.models = jQuery.fn.jplist.ui.list.models || {};
jQuery.fn.jplist.ui.list.controllers =
    jQuery.fn.jplist.ui.list.controllers || {};
jQuery.fn.jplist.ui.list.collections =
    jQuery.fn.jplist.ui.list.collections || {};
jQuery.fn.jplist.ui.list.views = jQuery.fn.jplist.ui.list.views || {};
jQuery.fn.jplist.ui.controls = jQuery.fn.jplist.ui.controls || {};
jQuery.fn.jplist.ui.itemControls = jQuery.fn.jplist.ui.itemControls || {};
jQuery.fn.jplist.ui.statuses = jQuery.fn.jplist.ui.statuses || {};
jQuery.fn.jplist.ui.panel = jQuery.fn.jplist.ui.panel || {};
jQuery.fn.jplist.ui.panel.controllers =
    jQuery.fn.jplist.ui.panel.controllers || {};
jQuery.fn.jplist.ui.panel.collections =
    jQuery.fn.jplist.ui.panel.collections || {};
(function() {
    jQuery.fn.jplist.app.events.PubSub = function(a, d) {
        var b = {
            options: d,
            $root: a,
            events: {
                init: "1",
                unknownStatusesChanged: "2",
                knownStatusesChanged: "3",
                statusChanged: "4",
                statusesChangedByDeepLinks: "5",
                listSorted: "6",
                listFiltered: "7",
                listPaginated: "8",
                dataItemAdded: "9",
                dataItemRemoved: "10",
                collectionReadyEvent: "11",
                statusesAppliedToList: "12",
                animationStartEvent: "13",
                animationStepEvent: "14",
                animationCompleteEvent: "15"
            }
        };
        return jQuery.extend(!0, jQuery({}), this, b);
    };
})();
(function() {
    jQuery.fn.jplist.app.dto.StatusDTO = function(a, d, b, c, f, e, g, h) {
        this.action = d;
        this.name = a;
        this.type = b;
        this.data = c;
        this.inStorage = f;
        this.inAnimation = e;
        this.isAnimateToTop = g;
        this.inDeepLinking = h;
    };
})();
(function() {
    jQuery.fn.jplist.app.History = function(a, d, b) {
        this.options = d;
        this.observer = b;
        this.$root = a;
        this.statusesQueue = [];
        this.listStatusesQueue = [];
    };
    jQuery.fn.jplist.app.History.prototype.addStatus = function(a) {
        this.statusesQueue.push(a);
        this.statusesQueue.length > this.options.historyLength &&
            this.statusesQueue.shift();
    };
    jQuery.fn.jplist.app.History.prototype.getLastStatus = function() {
        var a = null;
        0 < this.statusesQueue.length &&
            (a = this.statusesQueue[this.statusesQueue.length - 1]);
        return a;
    };
    jQuery.fn.jplist.app.History.prototype.popStatus = function() {
        var a = null;
        0 < this.statusesQueue.length && (a = this.statusesQueue.pop());
        return a;
    };
    jQuery.fn.jplist.app.History.prototype.getLastList = function() {
        var a = null;
        0 < this.listStatusesQueue.length &&
            (a = this.listStatusesQueue[this.listStatusesQueue.length - 1]);
        return a;
    };
    jQuery.fn.jplist.app.History.prototype.addList = function(a) {
        this.listStatusesQueue.push(a);
        this.listStatusesQueue.length > this.options.historyLength &&
            this.listStatusesQueue.shift();
    };
    jQuery.fn.jplist.app.History.prototype.popList = function() {
        var a = null;
        0 < this.listStatusesQueue.length && (a = this.listStatusesQueue.pop());
        return a;
    };
})();
(function() {
    var a = function(c, b, a, d) {
            b = [];
            for (var h, k = 0; k < c.statuses.length; k++)
                (h = c.statuses[k]),
                    h[a] === d && ((h.initialIndex = k), b.push(h));
            return b;
        },
        d = function(c, b) {
            for (var a = [], d, h = 0; h < c.statuses.length; h++)
                (d = c.statuses[h]), d.action === b && a.push(d);
            return a;
        },
        b = function(c, b, d) {
            var g, h, k, l;
            if (0 === c.statuses.length) c.statuses.push(b);
            else if (
                ((g = a(c, c.statuses, "action", b.action)), 0 === g.length)
            )
                c.statuses.push(b);
            else if (((k = a(c, g, "name", b.name)), 0 === k.length))
                c.statuses.push(b);
            else
                for (var m = 0; m < k.length; m++)
                    (g = k[m]),
                        g.type === b.type
                            ? d
                                ? (c.statuses[g.initialIndex] = b)
                                : g.data &&
                                  b.data &&
                                  ((h = !1),
                                  (l = []),
                                  jQuery.each(g.data, function(c, a) {
                                      b[c] !== a &&
                                          ((h = !0),
                                          l.push(
                                              c + ": " + b[c] + " !== " + a
                                          ));
                                  }),
                                  h &&
                                      jQuery.fn.jplist.warn(
                                          c.options,
                                          "The statuses have the same name, action and type, but different data values",
                                          [g, b, l]
                                      ))
                            : ((c.statuses[g.initialIndex] = jQuery.extend(
                                  !0,
                                  {},
                                  g,
                                  b
                              )),
                              (c.statuses[g.initialIndex].type = "combined"));
        };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection = function(c, b, a) {
        this.options = c;
        this.observer = b;
        this.statuses = a || [];
    };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection.prototype.getStatusesByAction = function(
        c
    ) {
        return d(this, c);
    };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection.prototype.add = function(
        c,
        a
    ) {
        return b(this, c, a);
    };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection.prototype.get = function(c) {
        var b = null;
        0 <= c && c < this.statuses.length && (b = this.statuses[c]);
        return b;
    };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection.prototype.toArray = function() {
        return this.statuses;
    };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection.prototype.getSortStatuses = function() {
        var c,
            b,
            a = [],
            g;
        c = d(this, "sort");
        if (jQuery.isArray(c))
            for (var h = 0; h < c.length; h++)
                if (
                    (b = c[h]) &&
                    b.data &&
                    b.data.sortGroup &&
                    jQuery.isArray(b.data.sortGroup) &&
                    0 < b.data.sortGroup.length
                )
                    for (var k = 0; k < b.data.sortGroup.length; k++)
                        (g = new jQuery.fn.jplist.app.dto.StatusDTO(
                            b.name,
                            b.action,
                            b.type,
                            b.data.sortGroup[k],
                            b.inStorage,
                            b.inAnimation,
                            b.isAnimateToTop,
                            b.inDeepLinking
                        )),
                            a.push(g);
                else a.push(b);
        return a;
    };
    jQuery.fn.jplist.app.dto.StatusesDTOCollection.prototype.getFilterStatuses = function() {
        var c,
            b,
            a,
            g = [];
        c = d(this, "filter");
        if (jQuery.isArray(c))
            for (var h = 0; h < c.length; h++)
                (b = c[h]) &&
                    b.data &&
                    b.data.filterType &&
                    ((a =
                        jQuery.fn.jplist.app.services.DTOMapperService.filters[
                            b.data.filterType
                        ]),
                    jQuery.isFunction(a) && g.push(b));
        return g;
    };
})();
(function() {
    jQuery.fn.jplist.app.services.DTOMapperService.filters = {};
    jQuery.fn.jplist.app.services.DTOMapperService.filters.TextFilter = function(
        a,
        d
    ) {
        var b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            null
        );
        return jQuery.fn.jplist.domain.dom.services.FiltersService.textFilter(
            a.data.value,
            b,
            d,
            a.data.ignore,
            a.data.mode
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.path = function(
        a,
        d
    ) {
        var b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            null
        );
        return jQuery.fn.jplist.domain.dom.services.FiltersService.pathFilter(
            b,
            d
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.range = function(
        a,
        d
    ) {
        var b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            null
        );
        return jQuery.fn.jplist.domain.dom.services.FiltersService.rangeFilter(
            b,
            d,
            a.data.min,
            a.data.max,
            a.data.prev,
            a.data.next
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.date = function(
        a,
        d
    ) {
        var b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            null
        );
        return jQuery.fn.jplist.domain.dom.services.FiltersService.dateFilter(
            a.data.year,
            a.data.month,
            a.data.day,
            b,
            d,
            a.data.format
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.dateRange = function(
        a,
        d
    ) {
        var b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            null
        );
        return jQuery.fn.jplist.domain.dom.services.FiltersService.dateRangeFilter(
            b,
            d,
            a.data.format,
            a.data.prev_year,
            a.data.prev_month,
            a.data.prev_day,
            a.data.next_year,
            a.data.next_month,
            a.data.next_day
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.pathGroup = function(
        a,
        d
    ) {
        return jQuery.fn.jplist.domain.dom.services.FiltersService.pathGroupFilter(
            a.data.pathGroup,
            d
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.textGroup = function(
        a,
        d
    ) {
        return jQuery.fn.jplist.domain.dom.services.FiltersService.textGroupFilter(
            a.data.textGroup,
            a.data.logic,
            a.data.path,
            a.data.ignoreRegex,
            d,
            a.data.mode
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.filters.textFilterPathGroup = function(
        a,
        d
    ) {
        return jQuery.fn.jplist.domain.dom.services.FiltersService.textFilterPathGroup(
            a.data.textAndPathsGroup,
            a.data.ignoreRegex,
            d,
            a.data.mode
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.sort = {};
    jQuery.fn.jplist.app.services.DTOMapperService.sort.text = function(
        a,
        d,
        b
    ) {
        var c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            a.data.type
        );
        return jQuery.fn.jplist.domain.dom.services.SortService.textHelper(
            d,
            b,
            a.data.order,
            c,
            a.data.ignore || ""
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.sort.number = function(
        a,
        d,
        b
    ) {
        var c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            a.data.type
        );
        return jQuery.fn.jplist.domain.dom.services.SortService.numbersHelper(
            d,
            b,
            a.data.order,
            c
        );
    };
    jQuery.fn.jplist.app.services.DTOMapperService.sort.datetime = function(
        a,
        d,
        b
    ) {
        var c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            a.data.path,
            a.data.type
        );
        return jQuery.fn.jplist.domain.dom.services.SortService.datetimeHelper(
            d,
            b,
            a.data.order,
            c,
            a.data.dateTimeFormat || ""
        );
    };
})();
(function() {
    jQuery.fn.jplist.logEnabled = function(a) {
        return (
            a.debug && window.console && jQuery.isFunction(window.console.log)
        );
    };
    jQuery.fn.jplist.log = function(a, d, b) {
        jQuery.fn.jplist.logEnabled(a) && window.console.log(d, b);
    };
    jQuery.fn.jplist.info = function(a, d, b) {
        jQuery.fn.jplist.logEnabled(a) && window.console.info(d, b);
    };
    jQuery.fn.jplist.error = function(a, d, b) {
        jQuery.fn.jplist.logEnabled(a) && window.console.error(d, b);
    };
    jQuery.fn.jplist.warn = function(a, d, b) {
        jQuery.fn.jplist.logEnabled(a) && window.console.warn(d, b);
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel = function(
        a,
        d
    ) {
        this.jqPath = a;
        this.dataType = d;
    };
    jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel.prototype.isEqual = function(
        a,
        d
    ) {
        var b = !1;
        d
            ? this.jqPath === a.jqPath && (b = !0)
            : this.jqPath === a.jqPath &&
              this.dataType === a.dataType &&
              (b = !0);
        return b;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.models.DataItemMemberModel = function(a, d) {
        this.$element = a;
        this.path = d;
        this.text = a.text();
        this.html = a.html();
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.models.DataItemModel = function(a, d, b) {
        this.pathitems = [];
        this.jqElement = this.$item = a;
        this.index = b;
        this.html = jQuery.fn.jplist.domain.dom.services.HelperService.getOuterHtml(
            a
        );
        var c, f;
        a = [];
        for (b = 0; b < d.length; b++)
            (c = d[b]),
                (f = this.$item.find(c.jqPath)),
                0 < f.length &&
                    ((c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberModel(
                        f,
                        c
                    )),
                    a.push(c));
        this.pathitems = a;
    };
    jQuery.fn.jplist.domain.dom.models.DataItemModel.prototype.findPathitem = function(
        a
    ) {
        for (var d = null, b, c = 0; c < this.pathitems.length; c++)
            if (((b = this.pathitems[c]), b.path.isEqual(a, !0))) {
                d = b;
                break;
            }
        return d;
    };
})();
(function() {
    var a = function(b, c) {
            var a, d, f;
            a = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
                b.options,
                b.observer,
                c
            ).getFilterStatuses();
            if (0 < a.length) {
                for (var e = 0; e < a.length; e++)
                    (d = a[e]),
                        (f =
                            jQuery.fn.jplist.app.services.DTOMapperService
                                .filters[d.data.filterType]),
                        (b.dataview = f(d, b.dataview));
                b.observer.trigger(b.observer.events.listFiltered, [c, b]);
            }
        },
        d = function(b, c) {
            var a,
                d = null,
                f;
            a = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
                b.options,
                b.observer,
                c
            ).getStatusesByAction("paging", c);
            if (0 < a.length) {
                for (var e = 0; e < a.length; e++)
                    (d = a[e]),
                        (f = d.data.currentPage || 0),
                        (d = new jQuery.fn.jplist.domain.dom.services.PaginationService(
                            f,
                            d.data.number,
                            b.dataview.length
                        )),
                        (a[e].data.paging = d),
                        (b.dataview = jQuery.fn.jplist.domain.dom.services.FiltersService.pagerFilter(
                            d,
                            b.dataview
                        ));
                b.observer.trigger(b.observer.events.listPaginated, [c, b]);
            }
        },
        b = function(b, c) {
            var a = [],
                a = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
                    b.options,
                    b.observer,
                    c
                ).getSortStatuses();
            0 < a.length &&
                (jQuery.fn.jplist.domain.dom.services.SortService.doubleSort(
                    a,
                    b.dataview
                ),
                b.observer.trigger(b.observer.events.listSorted, [c, b]));
        },
        c = function(b) {
            return jQuery(b.dataview).map(function(b, c) {
                return c.jqElement.get();
            });
        },
        f = function(b) {
            return jQuery(b.dataitems).map(function(b, c) {
                return c.jqElement.get();
            });
        },
        e = function(b) {
            b.dataview = jQuery.merge([], b.dataitems);
        },
        g = function(b, c) {
            for (var a, d = -1, f, e = 0; e < b.dataitems.length; e++)
                if (
                    ((a = b.dataitems[e]),
                    (a = jQuery.fn.jplist.domain.dom.services.HelperService.getOuterHtml(
                        a.jqElement
                    )),
                    (f = jQuery.fn.jplist.domain.dom.services.HelperService.getOuterHtml(
                        c
                    )),
                    a === f)
                ) {
                    d = e;
                    break;
                }
            return d;
        },
        h = function(b, c) {
            var a;
            a = g(b, c);
            -1 !== a &&
                (b.dataitems.splice(a, 1),
                b.observer.trigger(b.observer.events.dataItemRemoved, [
                    c,
                    b.dataitems
                ]));
        },
        k = function(b, c) {
            c.each(function() {
                h(b, jQuery(this));
            });
        },
        l = function(b, c, a, d) {
            c = new jQuery.fn.jplist.domain.dom.models.DataItemModel(c, a, d);
            b.dataitems.splice(d, 0, c);
            b.observer.trigger(b.observer.events.dataItemAdded, [
                c,
                b.dataitems
            ]);
        },
        m = function(b, c, a, d, f) {
            for (var e; a < c.length; a++)
                (e = c.eq(a)),
                    3 !== e.get(0).nodeType &&
                        (l(b, e, d, f),
                        a + 1 < c.length &&
                            0 === a % 50 &&
                            window.setTimeout(function() {
                                m(b, c, a, d, f);
                            }, 0));
        };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection = function(
        b,
        c,
        a,
        d
    ) {
        this.dataitems = [];
        this.dataview = [];
        this.options = b;
        this.observer = c;
        this.paths = d;
        0 < a.length && (m(this, a, 0, d, 0), e(this));
        this.observer.trigger(this.observer.events.collectionReadyEvent, [
            this
        ]);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.applyStatuses = function(
        c
    ) {
        e(this);
        b(this, c);
        a(this, c);
        d(this, c);
        this.observer.trigger(this.observer.events.statusesAppliedToList, [
            this,
            c
        ]);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.filter = function(
        b
    ) {
        a(this, b);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.sort = function(
        c
    ) {
        b(this, c);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.pagination = function(
        b
    ) {
        d(this, b);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.dataviewToJqueryObject = function() {
        return c(this);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.dataitemsToJqueryObject = function() {
        return f(this);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.resetDataview = function() {
        e(this);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.empty = function() {
        this.dataitems = [];
        this.dataview = [];
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.addDataItem = function(
        b,
        c,
        a
    ) {
        l(this, b, c, a);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.addDataItems = function(
        b,
        c,
        a
    ) {
        m(this, b, 0, c, a);
        e(this);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.delDataitem = function(
        b
    ) {
        h(this, b);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.delDataitems = function(
        b
    ) {
        k(this, b);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.indexOf = function(
        b
    ) {
        return g(this, b);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemsCollection.prototype.dataviewToString = function() {
        var b,
            c = "",
            a;
        for (a = 0; a < this.dataview.length; a++)
            (b = this.dataview[a]), (c += b.content);
        return c;
    };
})();
(function() {
    var a = function(a, b) {
        for (var c, f = !1, e = 0; e < a.paths.length; e++)
            if (((c = a.paths[e]), c.isEqual(b, !0))) {
                f = !0;
                break;
            }
        return f;
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemMemberPathCollection = function(
        a,
        b
    ) {
        this.options = a;
        this.observer = b;
        this.paths = [];
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemMemberPathCollection.prototype.add = function(
        d
    ) {
        a(this, d) || this.paths.push(d);
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemMemberPathCollection.prototype.addRange = function(
        d
    ) {
        for (var b = 0; b < d.length; b++) {
            var c = d[b];
            a(this, c) || this.paths.push(c);
        }
    };
    jQuery.fn.jplist.domain.dom.collections.DataItemMemberPathCollection.prototype.isPathInList = function(
        d
    ) {
        return a(this, d);
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.PaginationService = function(a, d, b) {
        b = Number(b);
        isNaN(b) && (b = 0);
        b = this.itemsNumber = b;
        null === d ? (d = b) : ((d = Number(d)), isNaN(d) && (d = b));
        this.itemsOnPage = d;
        d = (d = this.itemsOnPage) ? Math.ceil(this.itemsNumber / d) : 0;
        d = this.pagesNumber = d;
        a = Number(a);
        isNaN(a) && (a = 0);
        a > d - 1 && (a = 0);
        this.currentPage = a;
        this.start = this.currentPage * this.itemsOnPage;
        a = this.itemsNumber;
        d = this.start + this.itemsOnPage;
        d > a && (d = a);
        this.end = d;
        a = this.currentPage;
        this.prevPage = 0 >= a ? 0 : a - 1;
        a = this.currentPage;
        d = this.pagesNumber;
        this.nextPage = 0 === d ? 0 : a >= d - 1 ? d - 1 : a + 1;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.PaginationGoogleService = function(
        a,
        d,
        b
    ) {
        b = Number(b);
        isNaN(b) && (b = 0);
        b = this.itemsNumber = b;
        null === d ? (d = b) : ((d = Number(d)), isNaN(d) && (d = b));
        this.itemsOnPage = d;
        d = (d = this.itemsOnPage) ? Math.ceil(this.itemsNumber / d) : 0;
        d = this.pagesNumber = d;
        a = Number(a);
        isNaN(a) && (a = 0);
        a > d - 1 && (a = 0);
        this.currentPage = a;
        this.start = this.currentPage * this.itemsOnPage;
        a = this.itemsNumber;
        d = this.start + this.itemsOnPage;
        d > a && (d = a);
        this.end = d;
        a = this.currentPage;
        this.prevPage = 0 >= a ? 0 : a - 1;
        a = this.currentPage;
        d = this.pagesNumber;
        this.nextPage = 0 === d ? 0 : a >= d - 1 ? d - 1 : a + 1;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.dateFilter = function(
        a,
        d,
        b,
        c,
        f,
        e
    ) {
        for (var g, h, k = [], l = 0; l < f.length; l++)
            if (((g = f[l]), (h = g.findPathitem(c))))
                jQuery.isNumeric(a) &&
                jQuery.isNumeric(d) &&
                jQuery.isNumeric(b)
                    ? (h = jQuery.fn.jplist.domain.dom.services.HelperService.formatDateTime(
                          h.text,
                          e
                      )) &&
                      jQuery.isFunction(h.getFullYear) &&
                      (h.setHours(0),
                      h.setMinutes(0),
                      h.setSeconds(0),
                      h.getFullYear() === a &&
                          h.getMonth() === d &&
                          h.getDate() === b &&
                          k.push(g))
                    : k.push(g);
        return k;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.dateRangeFilter = function(
        a,
        d,
        b,
        c,
        f,
        e,
        g,
        h,
        k
    ) {
        for (var l = [], m, p, q, n, r = 0; r < d.length; r++)
            if (((m = d[r]), (p = m.findPathitem(a))))
                (q =
                    !jQuery.isNumeric(c) ||
                    !jQuery.isNumeric(f) ||
                    !jQuery.isNumeric(e)),
                    (n =
                        !jQuery.isNumeric(g) ||
                        !jQuery.isNumeric(h) ||
                        !jQuery.isNumeric(k)),
                    q || n
                        ? l.push(m)
                        : (n = jQuery.fn.jplist.domain.dom.services.HelperService.formatDateTime(
                              p.text,
                              b
                          )) &&
                          jQuery.isFunction(n.getFullYear) &&
                          ((p = new Date(c, f, e)),
                          (q = new Date(g, h, k)),
                          n.setHours(0),
                          n.setMinutes(0),
                          n.setSeconds(0),
                          n >= p && n <= q && l.push(m));
        return l;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.pagerFilter = function(
        a,
        d
    ) {
        return d.slice(a.start, a.end);
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.pathFilter = function(
        a,
        d
    ) {
        for (var b, c, f = [], e = 0; e < d.length; e++)
            (b = d[e]),
                "default" === a.jqPath
                    ? f.push(b)
                    : (c = b.findPathitem(a)) && f.push(b);
        return f;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.pathGroupFilter = function(
        a,
        d
    ) {
        var b,
            c = [],
            f,
            e = [];
        if (0 >= a.length) return d;
        for (f = 0; f < a.length; f++)
            (b = a[f]),
                (b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                    b,
                    null
                )),
                c.push(b);
        for (var g = 0; g < d.length; g++) {
            f = d[g];
            for (var h = 0; h < c.length; h++)
                if (((b = c[h]), "default" === b.jqPath)) {
                    e.push(f);
                    break;
                } else (b = f.findPathitem(b)) && e.push(f);
        }
        return e;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.rangeFilter = function(
        a,
        d,
        b,
        c,
        f,
        e
    ) {
        b = [];
        for (
            var g, h = jQuery.isNumeric(f), k = jQuery.isNumeric(e), l = 0;
            l < d.length;
            l++
        )
            if (((c = d[l]), (g = c.findPathitem(a))))
                (g = Number(g.text.replace(/[^-0-9\.]+/g, ""))),
                    isNaN(g) ||
                        (h && k
                            ? g >= f && g <= e && b.push(c)
                            : h && !k
                            ? g >= f && b.push(c)
                            : !h && k && g <= e && b.push(c));
        return b;
    };
})();
(function() {
    var a = function(b) {
            var a = [],
                d;
            if (b)
                for (var g = 0; g < b.length; g++)
                    (d = jQuery.trim(b[g])) && a.push(d);
            return a;
        },
        d = function(b, d) {
            var e = !1,
                g;
            g = d.split(" or ");
            g = a(g);
            if (0 < g.length)
                for (var e = -1 !== b.indexOf(g[0]), h = 1; h < g.length; h++)
                    e = e || -1 !== b.indexOf(g[h]);
            return e;
        },
        b = function(b, f) {
            var e,
                g,
                h = !1;
            e = f.split(" and ");
            e = a(e);
            if (0 < e.length) {
                g = e[0];
                for (
                    var h =
                            -1 === g.indexOf(" or ")
                                ? -1 !== b.indexOf(g)
                                : d(b, g),
                        k = 1;
                    k < e.length;
                    k++
                )
                    (g = e[k]),
                        (h =
                            -1 === g.indexOf(" or ")
                                ? h && -1 !== b.indexOf(g)
                                : h && d(b, g));
            }
            return h;
        };
    jQuery.fn.jplist.domain.dom.services.FiltersService.advancedSearchParse = function(
        c,
        f
    ) {
        f = jQuery.trim(f);
        if (
            -1 === f.indexOf(" or ") &&
            -1 === f.indexOf(" and ") &&
            -1 === f.indexOf("not ")
        )
            return -1 !== c.indexOf(f);
        var e,
            g,
            h = !1;
        e = f.split("not ");
        e = a(e);
        if (0 < e.length) {
            g = e[0];
            for (
                var h =
                        -1 === g.indexOf(" and ")
                            ? -1 === g.indexOf(" or ")
                                ? -1 === c.indexOf(g)
                                : d(c, g)
                            : b(c, g),
                    k = 1;
                k < e.length;
                k++
            )
                (g = e[k]),
                    (h =
                        -1 === g.indexOf(" and ")
                            ? (h =
                                  -1 === g.indexOf(" or ")
                                      ? h && -1 === c.indexOf(g)
                                      : h && d(c, g)) && d(c, g)
                            : h && b(c, g));
        }
        return h;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.textGroupFilter = function(
        a,
        d,
        b,
        c,
        f,
        e
    ) {
        var g, h, k;
        e = [];
        var l, m;
        if (0 >= a.length) return f;
        k = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            b,
            null
        );
        for (var p = 0; p < f.length; p++)
            if (((b = f[p]), (h = b.findPathitem(k)), "default" === k.jqPath))
                e.push(b);
            else if (h)
                if (
                    ((h = jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                        h.text,
                        c
                    )),
                    "or" === d)
                )
                    for (m = 0; m < a.length; m++) {
                        if (
                            ((g = a[m]),
                            (g = jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                                g,
                                c
                            )),
                            jQuery.fn.jplist.domain.dom.services.FiltersService.advancedSearchParse(
                                h,
                                g
                            ))
                        ) {
                            e.push(b);
                            break;
                        }
                    }
                else {
                    l = [];
                    for (m = 0; m < a.length; m++)
                        (g = a[m]),
                            (g = jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                                g,
                                c
                            )),
                            jQuery.fn.jplist.domain.dom.services.FiltersService.advancedSearchParse(
                                h,
                                g
                            ) && l.push(g);
                    l.length === a.length && e.push(b);
                }
        return e;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.textFilter = function(
        a,
        d,
        b,
        c,
        f
    ) {
        var e,
            g,
            h = [],
            k;
        f = f || "contains";
        for (var l = 0; l < b.length; l++)
            if (((e = b[l]), (g = e.findPathitem(d)), "default" === d.jqPath))
                h.push(e);
            else if (g)
                switch (
                    ((g = jQuery.trim(
                        jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                            g.text,
                            c
                        )
                    )),
                    (k = jQuery.trim(
                        jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                            a,
                            c
                        )
                    )),
                    f)
                ) {
                    case "startsWith":
                        g.startsWith(k) && h.push(e);
                        break;
                    case "endsWith":
                        g.endsWith(k) && h.push(e);
                        break;
                    case "advanced":
                        jQuery.fn.jplist.domain.dom.services.FiltersService.advancedSearchParse(
                            g,
                            k
                        ) && h.push(e);
                        break;
                    default:
                        -1 !== g.indexOf(k) && h.push(e);
                }
        return h;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.FiltersService.textFilterPathGroup = function(
        a,
        d,
        b,
        c
    ) {
        var f, e;
        c = [];
        var g = [],
            h,
            k,
            l;
        for (l = 0; l < a.length; l++)
            (k = a[l]),
                k.selected &&
                    ((f = k.path),
                    (e = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        f,
                        null
                    )),
                    (k.pathObj = e),
                    c.push(k));
        if (0 >= c.length) return b;
        for (f = 0; f < b.length; f++) {
            a = b[f];
            l = !1;
            for (var m = 0; m < c.length; m++)
                if (((k = c[m]), (e = k.pathObj)))
                    if ("default" === e.jqPath) {
                        l = !0;
                        break;
                    } else if ((e = a.findPathitem(e)))
                        switch (
                            ((e = jQuery.trim(
                                jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                                    e.text,
                                    d
                                )
                            )),
                            (h = jQuery.trim(
                                jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters(
                                    k.text,
                                    d
                                )
                            )),
                            k.mode)
                        ) {
                            case "startsWith":
                                e.startsWith(h) && (l = !0);
                                break;
                            case "endsWith":
                                e.endsWith(h) && (l = !0);
                                break;
                            case "advanced":
                                jQuery.fn.jplist.domain.dom.services.FiltersService.advancedSearchParse(
                                    e,
                                    h
                                ) && (l = !0);
                                break;
                            default:
                                -1 !== e.indexOf(h) && (l = !0);
                        }
            l && g.push(a);
        }
        return g;
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.SortService.datetimeHelper = function(
        a,
        d,
        b,
        c,
        f
    ) {
        a = a.findPathitem(c);
        d = d.findPathitem(c);
        return a && d
            ? (jQuery.trim(f)
                  ? ((c = jQuery.fn.jplist.domain.dom.services.HelperService.formatDateTime(
                        a.text,
                        f
                    )),
                    (f = jQuery.fn.jplist.domain.dom.services.HelperService.formatDateTime(
                        d.text,
                        f
                    )))
                  : ((c = new Date(Date.parse(a.text))),
                    (f = new Date(Date.parse(d.text)))),
              c == f ? 0 : "asc" == b ? (c > f ? 1 : -1) : c < f ? 1 : -1)
            : 0;
    };
    jQuery.fn.jplist.domain.dom.services.SortService.datetime = function(
        a,
        d,
        b,
        c
    ) {
        b.sort(function(b, e) {
            return jQuery.fn.jplist.domain.dom.services.SortService.datetimeHelper(
                b,
                e,
                a,
                d,
                c
            );
        });
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.SortService.numbersHelper = function(
        a,
        d,
        b,
        c
    ) {
        a = a.findPathitem(c);
        d = d.findPathitem(c);
        return a && d
            ? ((c = parseFloat(a.text.replace(/[^-0-9\.]+/g, ""))),
              (d = parseFloat(d.text.replace(/[^-0-9\.]+/g, ""))),
              (b =
                  c == d
                      ? 0
                      : "asc" == b
                      ? isNaN(c)
                          ? 1
                          : isNaN(d)
                          ? -1
                          : c - d
                      : isNaN(c)
                      ? 1
                      : isNaN(d)
                      ? -1
                      : d - c))
            : 0;
    };
    jQuery.fn.jplist.domain.dom.services.SortService.numbers = function(
        a,
        d,
        b
    ) {
        b.sort(function(b, f) {
            return jQuery.fn.jplist.domain.dom.services.SortService.numbersHelper(
                b,
                f,
                a,
                d
            );
        });
    };
})();
(function() {
    jQuery.fn.jplist.domain.dom.services.SortService.textHelper = function(
        a,
        d,
        b,
        c,
        f
    ) {
        a = a.findPathitem(c);
        d = d.findPathitem(c);
        return a && d
            ? (f
                  ? ((c = new RegExp(f, "ig")),
                    (f = a.text
                        .toString()
                        .replace(c, "")
                        .toLowerCase()),
                    (a = d.text
                        .toString()
                        .replace(c, "")
                        .toLowerCase()))
                  : ((f = a.text.toString().toLowerCase()),
                    (a = d.text.toString().toLowerCase())),
              f == a ? 0 : "asc" == b ? (f > a ? 1 : -1) : f < a ? 1 : -1)
            : 0;
    };
    jQuery.fn.jplist.domain.dom.services.SortService.text = function(
        a,
        d,
        b,
        c
    ) {
        b.sort(function(b, e) {
            return jQuery.fn.jplist.domain.dom.services.SortService.textHelper(
                b,
                e,
                a,
                d,
                c
            );
        });
    };
})();
(function() {
    var a = function(d, b, c, f) {
        var e = 0,
            g,
            h;
        if (0 < c.length) {
            g = c[f];
            if ("default" !== g.data.path) {
                if (
                    ((h =
                        jQuery.fn.jplist.app.services.DTOMapperService.sort[
                            g.data.type
                        ]),
                    jQuery.isFunction(h) &&
                        ((e = h(g, d, b)),
                        0 === e &&
                            jQuery.isArray(g.data.additionalPaths) &&
                            0 < g.data.additionalPaths.length))
                )
                    for (var k = 0; k < g.data.additionalPaths.length; k++)
                        (e = jQuery.extend(!0, {}, g)),
                            (e.data.path = g.data.additionalPaths[k]),
                            (e = h(e, d, b));
            } else
                (g = d.index),
                    (h = b.index),
                    (e = g === h ? 0 : isNaN(g) ? 1 : isNaN(h) ? -1 : g - h);
            0 === e && f + 1 < c.length && (e = a(d, b, c, f + 1));
        }
        return e;
    };
    jQuery.fn.jplist.domain.dom.services.SortService.doubleSort = function(
        d,
        b
    ) {
        var c = !1;
        1 === d.length &&
            d[0] &&
            d[0].data &&
            "default" === d[0].data.path &&
            (c = !0);
        c ||
            b.sort(function(b, c) {
                return a(b, c, d, 0);
            });
        return b;
    };
})();
(function() {
    var a = function(b, c) {
            var a = null;
            if ("{month}" == b) {
                c = c.toLowerCase();
                if ("january" === c || "jan" === c || "jan." === c) a = 0;
                if ("february" === c || "feb" === c || "feb." === c) a = 1;
                if ("march" === c || "mar" === c || "mar." === c) a = 2;
                if ("april" == c || "apr" === c || "apr." === c) a = 3;
                "may" === c && (a = 4);
                if ("july" == c || "jun" === c || "jun." === c) a = 5;
                if ("april" === c || "jul" === c || "jul." === c) a = 6;
                if ("august" === c || "aug" === c || "aug." === c) a = 7;
                if ("september" === c || "sep" === c || "sep." === c) a = 8;
                if ("october" === c || "oct" === c || "oct." === c) a = 9;
                if ("november" === c || "nov" === c || "nov." === c) a = 10;
                if ("december" === c || "dec" === c || "dec." === c) a = 11;
                null === a && ((a = parseInt(c, 10)), isNaN(a) || a--);
            } else a = parseInt(c, 10);
            return a;
        },
        d = function(b, c) {
            var a,
                d = null;
            a = b.replace(/{year}|{month}|{day}|{hour}|{min}|{sec}/g, ".*");
            (a = new RegExp(a, "g").exec(c)) && 1 < a.length && (d = a[1]);
            return d;
        };
    jQuery.fn.jplist.domain.dom.services.HelperService = {};
    jQuery.fn.jplist.domain.dom.services.HelperService.getOuterHtml = function(
        b
    ) {
        var a = "",
            d,
            e;
        if (b && b[0] && b[0].tagName) {
            d = b[0].attributes;
            e = b.html();
            b = b[0].tagName.toString().toLowerCase();
            for (var a = a + ("<" + b), g = 0; g < d.length; g++)
                d[g].nodeValue &&
                    ((a += " " + d[g].nodeName + "="),
                    (a += '"' + d[g].nodeValue + '"'));
            a = a + ">" + e;
            a += "</" + b + ">";
        }
        return a;
    };
    jQuery.fn.jplist.domain.dom.services.HelperService.removeCharacters = function(
        b,
        a
    ) {
        return b ? b.replace(new RegExp(a, "ig"), "").toLowerCase() : "";
    };
    jQuery.fn.jplist.domain.dom.services.HelperService.formatDateTime = function(
        b,
        c
    ) {
        var f, e, g, h, k, l;
        c = c.replace(/\./g, "\\.");
        c = c.replace(/\(/g, "\\(");
        c = c.replace(/\)/g, "\\)");
        c = c.replace(/\[/g, "\\[");
        c = c.replace(/\]/g, "\\]");
        f = c.replace("{year}", "(.*)");
        (e = d(f, b)) && (e = a("{year}", e));
        f = c.replace("{day}", "(.*)");
        (h = d(f, b)) && (h = a("{day}", h));
        f = c.replace("{month}", "(.*)");
        (g = d(f, b)) && (g = a("{month}", g));
        f = c.replace("{hour}", "(.*)");
        (k = d(f, b)) && (k = a("{hour}", k));
        f = c.replace("{min}", "(.*)");
        (l = d(f, b)) && (l = a("{min}", l));
        f = c.replace("{sec}", "(.*)");
        (f = d(f, b)) && (f = a("{sec}", f));
        if (!e || isNaN(e)) e = 1900;
        if (!g || isNaN(g)) g = 0;
        if (!h || isNaN(h)) h = 1;
        if (!k || isNaN(k)) k = 0;
        if (!l || isNaN(l)) l = 0;
        if (!f || isNaN(f)) f = 0;
        return new Date(e, g, h, k, l, f);
    };
})();
(function() {
    jQuery.fn.jplist.dal.services.DeepLinksService = {};
    jQuery.fn.jplist.dal.services.DeepLinksService.getUrlParams = function(a) {
        var d = [],
            b,
            c = [],
            f,
            d = window.decodeURIComponent(
                jQuery.trim(window.location.hash.replace(a.hashStart, ""))
            );
        if (a.deepLinking && "" !== jQuery.trim(d))
            for (var d = d.split(a.delimiter1), e = 0; e < d.length; e++)
                (b = d[e]),
                    (f = b.split("=")),
                    2 === f.length &&
                        ((b = f[0]),
                        (f = f[1]),
                        (b = b.split(a.delimiter0)),
                        2 === b.length &&
                            ((b = {
                                controlName: b[0],
                                propName: b[1],
                                propValue: f
                            }),
                            c.push(b)));
        return c;
    };
    jQuery.fn.jplist.dal.services.DeepLinksService.updateUrlPerControls = function(
        a,
        d
    ) {
        if (a.deepLinking) {
            jQuery.fn.jplist.info(
                a,
                "Change Deep links URL according to statuses: ",
                d
            );
            var b = jQuery.trim(d.replace(a.hashStart, "")),
                c,
                b = "" === b ? a.hashStart : a.hashStart + b;
            window.location.hash !== b &&
                ((c = window.location.href.indexOf(a.hashStart)),
                (b =
                    -1 == c
                        ? window.location.href + b
                        : window.location.href.substring(0, c) + b),
                "replaceState" in window.history
                    ? window.history.replaceState("", "", b)
                    : window.location.replace(b));
        }
    };
})();
(function() {
    jQuery.fn.jplist.domain.server.models.DataItemModel = function(a, d, b) {
        this.content = "";
        this.dataType = d;
        this.count = 0;
        this.responseText = b;
        this.dataType || (this.dataType = "html");
        switch (this.dataType) {
            case "html":
                d = jQuery(a);
                0 < d.length &&
                    ((this.content = d.html()),
                    (this.count = Number(d.attr("data-count")) || 0));
                break;
            case "json":
                this.content = a.data;
                this.count = a.count;
                break;
            case "xml":
                (d = jQuery(a).find("root")),
                    (this.count = Number(d.attr("count")) || 0),
                    (this.content = 0 < this.count ? a : "");
        }
    };
})();
(function() {
    jQuery.fn.jplist.animation = {};
    jQuery.fn.jplist.animation.drawItems = function(a, d, b, c, f, e, g, h) {
        var k, l, m;
        if ((f = jQuery.fn.jplist.animation[f])) {
            k = f.before;
            m = f.effect;
            l = f.after;
            jQuery.isFunction(k) && k(a, d, b, c);
            if (jQuery.isFunction(m))
                h.on(h.events.animationStepEvent, function(e, f, g) {
                    m(a, d, b, c, f);
                });
            h.on(h.events.animationCompleteEvent, function(e) {
                jQuery.isFunction(l) && l(a, d, b, c);
                h.off(h.events.animationStepEvent);
                h.off(h.events.animationCompleteEvent);
                jQuery.isFunction(g) && g();
            });
            e.play(a.duration);
        } else jQuery.isFunction(g) && g();
    };
})();
(function() {
    var a = function(b) {
            b.handler && window.clearTimeout(b.handler);
            b.progress = 0;
            b.start = null;
            b.observer.trigger(b.observer.events.animationCompleteEvent, []);
        },
        d = function(b, c) {
            jQuery.isNumeric(c) && 0 < c
                ? (b.handler = window.setTimeout(function() {
                      var f;
                      null === b.start &&
                          (b.observer.trigger(
                              b.observer.events.animationStartEvent,
                              []
                          ),
                          (b.start = new Date().getTime()));
                      f = new Date().getTime() - b.start;
                      b.progress = f / c;
                      1 <= b.progress && (b.progress = 1);
                      b.observer.trigger(b.observer.events.animationStepEvent, [
                          100 * b.progress,
                          b
                      ]);
                      1 > b.progress ? d(b, c) : a(b);
                  }, b.delay))
                : a(b);
        };
    jQuery.fn.jplist.animation.Timeline = function(b, a, d) {
        this.$scene = b;
        this.options = a;
        this.observer = d;
        this.start = null;
        this.progress = 0;
        this.handler = this.delay = null;
        this.delay = 1e3 / this.options.fps;
    };
    jQuery.fn.jplist.animation.Timeline.prototype.play = function(b) {
        d(this, b);
    };
    jQuery.fn.jplist.animation.Timeline.prototype.stop = function() {
        a(this);
    };
})();
(function() {
    jQuery.fn.jplist.animation.fade = {};
    jQuery.fn.jplist.animation.fade.before = function(a, d, b, c) {};
    jQuery.fn.jplist.animation.fade.effect = function(a, d, b, c, f) {
        d.find(a.itemPath).css({ opacity: (100 - f) / 100 });
    };
    jQuery.fn.jplist.animation.fade.after = function(a, d, b, c) {
        d.empty();
        c.css({ opacity: 1 });
        d.append(c);
    };
})();
(function() {
    var a = function(a, b, c) {
        var f = b.dataitemsToJqueryObject(),
            e = b.dataviewToJqueryObject(),
            g = !1,
            h,
            k = jQuery.extend(!0, {}, a.options, { duration: 0 });
        0 >= f.length || 0 >= e.length
            ? (a.$noResults.removeClass("jplist-hidden"),
              a.$itemsBox.addClass("jplist-hidden"),
              jQuery.isFunction(a.options.redrawCallback) &&
                  a.options.redrawCallback(b, e, c))
            : (a.$noResults.addClass("jplist-hidden"),
              a.$itemsBox.removeClass("jplist-hidden"),
              a.options.effect
                  ? (a.history &&
                        (h = a.history.getLastStatus()) &&
                        !h.inAnimation &&
                        (g = !0),
                    (g = g ? k : a.options),
                    jQuery.fn.jplist.animation.drawItems(
                        g,
                        a.$itemsBox,
                        f,
                        e,
                        a.options.effect,
                        a.timeline,
                        function() {
                            jQuery.isFunction(a.options.redrawCallback) &&
                                a.options.redrawCallback(b, e, c);
                        },
                        a.observer
                    ))
                  : (f.detach(),
                    a.$itemsBox.append(e),
                    jQuery.isFunction(a.options.redrawCallback) &&
                        a.options.redrawCallback(b, e, c)));
    };
    jQuery.fn.jplist.ui.list.views.DOMView = function(a, b, c, f) {
        this.options = b;
        this.$root = a;
        this.observer = c;
        this.history = f;
        this.timelineZero = this.timeline = null;
        this.$itemsBox = a.find(b.itemsBox).eq(0);
        this.$noResults = a.find(b.noResults);
        this.options.effect &&
            (this.timeline = new jQuery.fn.jplist.animation.Timeline(
                this.$root,
                this.options,
                this.observer
            ));
    };
    jQuery.fn.jplist.ui.list.views.DOMView.prototype.render = function(d, b) {
        a(this, d, b);
    };
})();
(function() {
    jQuery.fn.jplist.ui.list.controllers.DOMController = function(
        a,
        d,
        b,
        c,
        f
    ) {
        this.options = d;
        this.observer = b;
        this.$root = a;
        this.history = f;
        this.storage = new jQuery.fn.jplist.dal.Storage(a, d, b);
        this.listView = this.itemControls = this.collection = null;
        this.itemControls = new jQuery.fn.jplist.ui.list.collections.ItemControlCollection(
            d,
            b,
            f,
            a
        );
        this.listView = new jQuery.fn.jplist.ui.list.views.DOMView(a, d, b, f);
        a = c.paths;
        d = this.$root
            .find(this.options.itemsBox)
            .eq(0)
            .find(this.options.itemPath);
        this.collection = new jQuery.fn.jplist.domain.dom.collections.DataItemsCollection(
            this.options,
            this.observer,
            d,
            a
        );
    };
    jQuery.fn.jplist.ui.list.controllers.DOMController.prototype.renderStatuses = function(
        a
    ) {
        this.storage.save(a);
        this.collection &&
            (this.collection.applyStatuses(a),
            this.listView.render(this.collection, a));
    };
})();
(function() {
    var a = function(a, b) {
        var c = "html";
        a.options.dataSource &&
            a.options.dataSource.server &&
            a.options.dataSource.server.ajax &&
            ((c = a.options.dataSource.server.ajax.dataType) || (c = "html"));
        a.storage.save(b);
        jQuery.fn.jplist.dal.services.URIService.get(
            b,
            a.options,
            function(b, e, g, h) {
                b = new jQuery.fn.jplist.domain.server.models.DataItemModel(
                    b,
                    c,
                    h.responseText
                );
                var k;
                g = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
                    a.options,
                    a.observer,
                    e
                ).getStatusesByAction("paging", e);
                for (h = 0; h < g.length; h++)
                    (k = g[h]),
                        k.data.currentPage || (k.data.currentPage = 0),
                        (k = new jQuery.fn.jplist.domain.dom.services.PaginationService(
                            k.data.currentPage,
                            k.data.number,
                            b.count
                        )),
                        (g[h].data.paging = k);
                a.observer.trigger(a.observer.events.statusesAppliedToList, [
                    null,
                    e
                ]);
                a.model.set(b, e);
            },
            function(b) {},
            function(b) {}
        );
    };
    jQuery.fn.jplist.ui.list.controllers.ServerController = function(
        a,
        b,
        c,
        f,
        e
    ) {
        this.options = b;
        this.observer = c;
        this.history = e;
        this.storage = new jQuery.fn.jplist.dal.Storage(a, b, c);
        f = jQuery({});
        f.$root = null;
        f.events = { modelChanged: "modelChanged" };
        this.scopeObserver = f;
        this.$root = a;
        this.model = this.view = null;
        this.model = new jQuery.fn.jplist.ui.list.models.DataItemModel(
            null,
            null,
            this.scopeObserver
        );
        this.view = new jQuery.fn.jplist.ui.list.views.ServerView(
            a,
            b,
            c,
            this.scopeObserver,
            this.model,
            this.history
        );
    };
    jQuery.fn.jplist.ui.list.controllers.ServerController.prototype.renderStatuses = function(
        d
    ) {
        a(this, d);
    };
})();
(function() {
    var a = function(b, a, d) {
            var e = !1,
                g,
                h = jQuery.extend(!0, {}, b.options, { duration: 0 });
            a.content && "" !== jQuery.trim(a.content)
                ? (b.$noResults.addClass("jplist-hidden"),
                  b.$itemsBox.removeClass("jplist-hidden"))
                : (b.$noResults.removeClass("jplist-hidden"),
                  b.$itemsBox.addClass("jplist-hidden"));
            b.options.effect
                ? (b.history &&
                      (g = b.history.getLastStatus()) &&
                      !g.inAnimation &&
                      (e = !0),
                  (e = e ? h : b.options),
                  jQuery.fn.jplist.animation.drawItems(
                      e,
                      b.$itemsBox,
                      null,
                      jQuery(a.content),
                      b.options.effect,
                      b.timeline,
                      function() {
                          jQuery.isFunction(b.options.redrawCallback) &&
                              b.options.redrawCallback(a.content, d);
                      },
                      b.observer
                  ))
                : (b.options.dataSource &&
                  jQuery.isFunction(b.options.dataSource.render)
                      ? b.options.dataSource.render(a, d)
                      : b.$itemsBox.html(a.content),
                  jQuery.isFunction(b.options.redrawCallback) &&
                      b.options.redrawCallback(a.content, d));
        },
        d = function(b) {
            b.scopeObserver.on(b.scopeObserver.events.modelChanged, function(
                c,
                d,
                e
            ) {
                b.$preloader && b.$preloader.addClass("jplist-hidden");
                b.$itemsBox.removeClass("jplist-hidden");
                a(b, d, e);
            });
        };
    jQuery.fn.jplist.ui.list.views.ServerView = function(a, c, f, e, g, h) {
        this.options = c;
        this.$root = a;
        this.observer = f;
        this.scopeObserver = e;
        this.model = g;
        this.history = h;
        this.$itemsBox = a.find(c.itemsBox).eq(0);
        this.$noResults = a.find(c.noResults);
        this.timeline = this.$preloader = null;
        this.options.effect &&
            (this.timeline = new jQuery.fn.jplist.animation.Timeline(
                this.$root,
                this.options,
                this.observer
            ));
        d(this);
    };
})();
(function() {
    jQuery.fn.jplist.ui.list.models.DataItemModel = function(a, d, b) {
        this.dataItem = a;
        this.statuses = d;
        this.scopeObserver = b;
    };
    jQuery.fn.jplist.ui.list.models.DataItemModel.prototype.set = function(
        a,
        d
    ) {
        this.dataItem = a;
        this.statuses = d;
        this.scopeObserver.trigger(this.scopeObserver.events.modelChanged, [
            a,
            d
        ]);
    };
})();
(function() {
    jQuery.fn.jplist.ui.list.ItemControlFactory = function(a, d, b, c) {
        this.options = a;
        this.observer = d;
        this.history = b;
        this.$root = c;
    };
    jQuery.fn.jplist.ui.list.ItemControlFactory.prototype.create = function(a) {
        var d = null,
            b,
            c,
            f = null,
            e = null;
        b = a.attr("data-control-type");
        c = {};
        jQuery.fn.jplist.itemControlTypes[b] &&
            (c = jQuery.extend(
                !0,
                {},
                c,
                jQuery.fn.jplist.itemControlTypes[b]
            ));
        this.options.itemControlTypes &&
            this.options.itemControlTypes[b] &&
            (c = jQuery.extend(!0, {}, c, this.options.itemControlTypes[b]));
        c &&
            (c.className && (f = jQuery.fn.jplist.ui.itemControls[c.className]),
            c.options && (e = c.options));
        b = {
            type: b,
            itemControlType: c,
            controlTypeClass: f,
            controlOptions: e
        };
        b = jQuery.extend(!0, b, {
            $control: a,
            history: this.history,
            observer: this.observer,
            options: this.options,
            $root: this.$root
        });
        b.controlTypeClass &&
            jQuery.isFunction(b.controlTypeClass) &&
            (d = new b.controlTypeClass(b));
        return d;
    };
})();
(function() {
    var a = function(a) {
        var b;
        a.options &&
            a.options.itemsBox &&
            ((b = a.$root.find(a.options.itemsBox)),
            0 < b.length &&
                b.find("[data-control-type]").each(function() {
                    var b = jQuery(this);
                    (b = a.controlFactory.create(b)) && a.controls.push(b);
                }));
    };
    jQuery.fn.jplist.ui.list.collections.ItemControlCollection = function(
        d,
        b,
        c,
        f
    ) {
        this.options = d;
        this.observer = b;
        this.history = c;
        this.$root = f;
        this.controls = [];
        this.controlFactory = null;
        this.controlFactory = new jQuery.fn.jplist.ui.list.ItemControlFactory(
            d,
            b,
            c,
            f
        );
        a(this);
    };
})();
(function() {
    var a = function(a) {
            var b = jQuery(window).scrollTop(),
                c;
            c = Number(a.data("top"));
            isNaN(c) ||
                (b > c
                    ? a.addClass("jplist-sticky")
                    : a.removeClass("jplist-sticky"));
        },
        d = function(b, c) {
            c.each(function() {
                var b = jQuery(this),
                    c = b.offset().top;
                b.data("top", c);
                a(b);
            });
            jQuery(window).scroll(function() {
                c.each(function() {
                    a(jQuery(this));
                });
            });
        },
        b = function(a) {
            var b = [];
            if (
                "cookies" === a.options.storage ||
                ("localstorage" === a.options.storage &&
                    jQuery.fn.jplist.dal.services.LocalStorageService.supported())
            )
                if (
                    (jQuery.fn.jplist.info(
                        a.options,
                        "Storage enabled: ",
                        a.options.storage
                    ),
                    "cookies" === a.options.storage &&
                        (b = jQuery.fn.jplist.dal.services.CookiesService.restoreCookies(
                            a.options.storageName
                        )),
                    "localstorage" === a.options.storage &&
                        jQuery.fn.jplist.dal.services.LocalStorageService.supported() &&
                        (b = jQuery.fn.jplist.dal.services.LocalStorageService.restore(
                            a.options.storageName
                        )),
                    0 < b.length)
                ) {
                    for (var d = [], f = 0; f < b.length; f++)
                        b[f].inStorage && d.push(b[f]);
                    0 < d.length &&
                        (a.controls.setStatuses(d, !0),
                        a.observer.trigger(
                            a.observer.events.knownStatusesChanged,
                            [d]
                        ));
                } else c(a, !0);
            else c(a, !0);
        },
        c = function(a, b) {
            var c;
            c = a.controls.getStatuses(b);
            a.observer.trigger(a.observer.events.knownStatusesChanged, [c]);
        },
        f = function(a) {
            var b;
            b = [];
            b = a.$root.find(a.options.panelPath).find("[data-control-type]");
            a.controls = new jQuery.fn.jplist.ui.panel.collections.ControlsCollection(
                a.options,
                a.observer,
                a.history,
                a.$root,
                b
            );
            a.paths = a.controls.getPaths();
            jQuery.fn.jplist.logEnabled(a.options) &&
                ((b = jQuery.map(a.paths, function(a, b) {
                    return a && a.jqPath ? a.jqPath : "";
                })),
                jQuery.fn.jplist.info(
                    a.options,
                    "Panel paths: ",
                    b.join(", ")
                ));
        };
    jQuery.fn.jplist.ui.panel.controllers.PanelController = function(
        a,
        b,
        c,
        k
    ) {
        this.options = b;
        this.$root = a;
        this.history = c;
        this.observer = k;
        this.controls = this.paths = this.$sticky = null;
        f(this);
        this.$sticky = a.find('[data-sticky="true"]');
        0 < this.$sticky.length && d(this, this.$sticky);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.setStatusesByDeepLink = function() {
        var a;
        a = jQuery.fn.jplist.dal.services.DeepLinksService.getUrlParams(
            this.options
        );
        jQuery.fn.jplist.info(this.options, "Set statuses by deep link: ", a);
        0 >= a.length ? b(this) : this.controls.setDeepLinks(a);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.setStatusesFromStorage = function() {
        b(this);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.setStatuses = function(
        a
    ) {
        this.controls.setStatuses(a, !1);
        this.history.addList(a);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.unknownStatusesChanged = function(
        a
    ) {
        c(this, a);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.mergeStatuses = function(
        a
    ) {
        if (a.isAnimateToTop) {
            var b;
            b = jQuery(this.options.animateToTop).offset().top;
            jQuery("html, body").animate(
                { scrollTop: b },
                this.options.animateToTopDuration
            );
        }
        a = this.controls.merge(!1, a);
        this.observer.trigger(this.observer.events.knownStatusesChanged, [a]);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.statusesChangedByDeepLinks = function(
        a,
        b
    ) {
        this.controls && this.controls.statusesChangedByDeepLinks(b);
    };
    jQuery.fn.jplist.ui.panel.controllers.PanelController.prototype.getDeepLinksURLPerControls = function() {
        return this.controls.getDeepLinksUrl();
    };
})();
(function() {
    jQuery.fn.jplist.ui.panel.ControlFactory = function(a, d, b, c) {
        this.options = a;
        this.observer = d;
        this.history = b;
        this.$root = c;
    };
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.create = function(a, d) {
        var b = null,
            c,
            f,
            e,
            g,
            h,
            k,
            l,
            m;
        c = a.attr("data-control-type");
        h = g = e = !0;
        k = !1;
        m = l = null;
        (f = a.attr("data-control-deep-link")) &&
            "false" === f.toString() &&
            (e = !1);
        (f = a.attr("data-control-storage")) &&
            "false" === f.toString() &&
            (g = !1);
        (f = a.attr("data-control-animation")) &&
            "false" === f.toString() &&
            (h = !1);
        (f = a.attr("data-control-animate-to-top")) &&
            "true" === f.toString() &&
            (k = !0);
        f = {};
        jQuery.fn.jplist.controlTypes[c] &&
            (f = jQuery.extend(!0, {}, f, jQuery.fn.jplist.controlTypes[c]));
        this.options.controlTypes &&
            this.options.controlTypes[c] &&
            (f = jQuery.extend(!0, {}, f, this.options.controlTypes[c]));
        f &&
            (f.className && (l = jQuery.fn.jplist.ui.controls[f.className]),
            f.options && (m = f.options));
        c = {
            type: c,
            action: a.attr("data-control-action"),
            name: a.attr("data-control-name"),
            inDeepLinking: e,
            inStorage: g,
            inAnimation: h,
            isAnimateToTop: k,
            controlType: f,
            controlTypeClass: l,
            controlOptions: m,
            paths: []
        };
        c = jQuery.extend(!0, c, {
            $control: a,
            history: this.history,
            observer: this.observer,
            options: this.options,
            $root: this.$root,
            controlsCollection: d
        });
        c.controlTypeClass &&
            jQuery.isFunction(c.controlTypeClass) &&
            (b = new c.controlTypeClass(c));
        return b;
    };
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.getStatus = function(a) {
        return null;
    };
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.setStatus = function(
        a,
        d
    ) {};
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.getDeepLink = function() {
        return "";
    };
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.getStatusByDeepLink = function(
        a,
        d
    ) {
        return null;
    };
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.getPaths = function(a) {
        return [];
    };
    jQuery.fn.jplist.ui.panel.ControlFactory.prototype.setByDeepLink = function(
        a
    ) {};
})();
(function() {
    var a = function(a, c) {
            var d, e;
            d = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
                a.options,
                a.observer,
                []
            );
            for (var g = 0; g < a.controls.length; g++)
                (e = a.controls[g]),
                    jQuery.isFunction(e.getStatus) &&
                        (e = e.getStatus(c)) &&
                        d.add(e, !1);
            jQuery.fn.jplist.info(a.options, "getStatuses: ", d);
            return d.toArray();
        },
        d = function(a, c) {
            var d = a.controlFactory.create(c, a);
            d && a.controls.push(d);
        };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection = function(
        a,
        c,
        f,
        e,
        g
    ) {
        this.options = a;
        this.observer = c;
        this.history = f;
        this.$root = e;
        this.controlFactory = null;
        this.$controls = g;
        this.controls = [];
        this.controlFactory = new jQuery.fn.jplist.ui.panel.ControlFactory(
            a,
            c,
            f,
            e
        );
        for (c = 0; c < this.$controls.length; c++)
            (a = this.$controls.eq(c)), d(this, a);
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.merge = function(
        b,
        c
    ) {
        var d, e;
        e = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
            this.options,
            this.observer,
            []
        );
        d = a(this, b);
        for (var g = 0; g < d.length; g++) e.add(d[g], !1);
        e.add(c, !0);
        return e.toArray();
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.statusesChangedByDeepLinks = function(
        a
    ) {
        for (var c, d = 0; d < this.controls.length; d++)
            (c = this.controls[d]),
                jQuery.isFunction(c.setByDeepLink) && c.setByDeepLink(a);
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.setDeepLinks = function(
        a
    ) {
        var c,
            d,
            e,
            g = new jQuery.fn.jplist.app.dto.StatusesDTOCollection(
                this.options,
                this.observer,
                []
            ),
            h;
        for (h = 0; h < a.length; h++) {
            c = a[h];
            d = c.controlName;
            var k = [];
            e = void 0;
            for (var l = 0; l < this.controls.length; l++)
                (e = this.controls[l]), e.name === d && k.push(e);
            d = k;
            for (k = 0; k < d.length; k++)
                (e = d[k]),
                    jQuery.isFunction(e.getStatusByDeepLink) &&
                        (e = e.getStatusByDeepLink(c.propName, c.propValue)) &&
                        g.add(e, !1);
        }
        this.observer.trigger(this.observer.events.knownStatusesChanged, [
            g.toArray()
        ]);
        this.observer.trigger(this.observer.events.statusesChangedByDeepLinks, [
            ,
            g.toArray(),
            a
        ]);
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.setStatuses = function(
        a,
        c
    ) {
        for (var d, e, g = 0; g < a.length; g++) {
            d = a[g];
            e = d.name;
            for (
                var h = d.action, k = [], l = void 0, m = 0;
                m < this.controls.length;
                m++
            )
                (l = this.controls[m]),
                    l.name === e && l.action === h && k.push(l);
            e = k;
            for (h = 0; h < e.length; h++)
                jQuery.isFunction(e[h].setStatus) && e[h].setStatus(d, c);
        }
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.getDeepLinksUrl = function() {
        var a;
        a = "";
        var c = [],
            d = "",
            e;
        e = this.controls;
        for (var g = 0; g < e.length; g++)
            (a = e[g]),
                jQuery.isFunction(a.getDeepLink) &&
                    (d = jQuery.trim(a.getDeepLink())),
                "" !== d && -1 === jQuery.inArray(d, c) && c.push(d);
        return (a = c.join(this.options.delimiter1));
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.getStatuses = function(
        b
    ) {
        return a(this, b);
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.getPaths = function() {
        var a,
            c = [],
            d;
        d = new jQuery.fn.jplist.domain.dom.collections.DataItemMemberPathCollection(
            this.options,
            this.observer
        );
        for (var e = 0; e < this.controls.length; e++)
            (a = this.controls[e]),
                jQuery.isFunction(a.getPaths) && (a.getPaths(c), d.addRange(c));
        return d.paths;
    };
    jQuery.fn.jplist.ui.panel.collections.ControlsCollection.prototype.add = function(
        a
    ) {
        d(this, a);
    };
})();
(function() {
    var a = function(a) {
            var b = [];
            a = jQuery();
            jQuery(document)
                .find("[data-control-type]")
                .each(function() {
                    var a = jQuery(this),
                        c = a.attr("data-control-type");
                    c &&
                        jQuery.fn.jplist.controlTypes[c] &&
                        jQuery.fn.jplist.controlTypes[c].dropdown &&
                        b.push(a);
                });
            for (var d = 0; d < b.length; d++) a = a.add(b[d]);
            return a;
        },
        d = function(b) {
            var d = a(b);
            0 < d.length &&
                (jQuery(document).click(function() {
                    d.find("ul").hide();
                }),
                jQuery(document)
                    .off(b.DROPDOWN_CLOSE_EVENT)
                    .on(b.DROPDOWN_CLOSE_EVENT, function(a, b) {
                        d.each(function() {
                            jQuery(this).is(b) ||
                                jQuery(this)
                                    .find("ul")
                                    .hide();
                        });
                    }));
            b.$control
                .find(".jplist-dd-panel")
                .off()
                .on("click", function(a) {
                    var d;
                    a.stopPropagation();
                    a = jQuery(this).parents("[data-control-type]");
                    d = a.find("ul");
                    jQuery(document).trigger(b.DROPDOWN_CLOSE_EVENT, [a]);
                    d.toggle(0);
                });
        },
        b = function(a, b, e, g) {
            a = {
                options: a,
                observer: b,
                history: e,
                $control: g,
                DROPDOWN_CLOSE_EVENT: "dropdown-close-event"
            };
            b = a.$control.find("li:eq(0)");
            b.addClass("active");
            b = b.find("span");
            0 >= a.$control.find(".jplist-dd-panel").length &&
                a.$control.prepend(
                    '<div class="jplist-dd-panel">' + b.text() + "</div>"
                );
            d(a);
            return jQuery.extend(this, a);
        };
    jQuery.fn.jplist.ui.panel.DropdownControl = function(a, d, e, g) {
        return new b(a, d, e, g);
    };
})();
(function() {
    jQuery.fn.jplist.dal.Storage = function(a, d, b) {
        this.options = d;
        this.observer = b;
        this.$root = a;
        this.isStorageEnabled = !1;
        this.isStorageEnabled =
            "cookies" === this.options.storage ||
            ("localstorage" === this.options.storage &&
                jQuery.fn.jplist.dal.services.LocalStorageService.supported());
    };
    jQuery.fn.jplist.dal.Storage.prototype.save = function(a) {
        var d = [],
            b;
        if (a && this.isStorageEnabled) {
            for (var c = 0; c < a.length; c++)
                (b = a[c]), b.inStorage && d.push(b);
            "cookies" === this.options.storage &&
                jQuery.fn.jplist.dal.services.CookiesService.saveCookies(
                    d,
                    this.options.storageName,
                    this.options.cookiesExpiration
                );
            "localstorage" === this.options.storage &&
                jQuery.fn.jplist.dal.services.LocalStorageService.supported() &&
                jQuery.fn.jplist.dal.services.LocalStorageService.save(
                    d,
                    this.options.storageName
                );
        }
    };
})();
(function() {
    jQuery.fn.jplist.dal.services.CookiesService = {};
    jQuery.fn.jplist.dal.services.CookiesService.setCookie = function(a, d, b) {
        d = escape(d);
        var c = new Date();
        b = Number(b);
        -1 == b || isNaN(b)
            ? (document.cookie = a + "=" + d + ";path=/;")
            : (c.setMinutes(c.getMinutes() + b),
              (document.cookie =
                  a + "=" + d + ";path=/; expires=" + c.toUTCString()));
    };
    jQuery.fn.jplist.dal.services.CookiesService.getCookie = function(a) {
        var d,
            b,
            c,
            f = null;
        c = document.cookie.split(";");
        for (var e = 0; e < c.length; e++)
            if (
                ((d = c[e].substr(0, c[e].indexOf("="))),
                (b = c[e].substr(c[e].indexOf("=") + 1)),
                (d = d.replace(/^\s+|\s+$/g, "")),
                d == a)
            ) {
                f = unescape(b);
                break;
            }
        return f;
    };
    jQuery.fn.jplist.dal.services.CookiesService.saveCookies = function(
        a,
        d,
        b
    ) {
        a = JSON.stringify(a);
        jQuery.fn.jplist.dal.services.CookiesService.setCookie(d, a, b);
    };
    jQuery.fn.jplist.dal.services.CookiesService.restoreCookies = function(a) {
        var d = [];
        (a = jQuery.fn.jplist.dal.services.CookiesService.getCookie(a)) &&
            (d = jQuery.parseJSON(a));
        d || (d = []);
        return d;
    };
})();
(function() {
    jQuery.fn.jplist.dal.services.LocalStorageService = {};
    jQuery.fn.jplist.dal.services.LocalStorageService.supported = function() {
        try {
            return "localStorage" in window && null !== window.localStorage;
        } catch (a) {
            return !1;
        }
    };
    jQuery.fn.jplist.dal.services.LocalStorageService.save = function(a, d) {
        var b;
        b = JSON.stringify(a);
        window.localStorage[d] = b;
    };
    jQuery.fn.jplist.dal.services.LocalStorageService.restore = function(a) {
        var d = [];
        (a = window.localStorage[a]) && (d = jQuery.parseJSON(a));
        d || (d = []);
        return d;
    };
})();
(function() {
    jQuery.fn.jplist.dal.services.URIService = {};
    jQuery.fn.jplist.dal.services.URIService.get = function(a, d, b, c, f) {
        var e = d.dataSource.server;
        e.ajax.data || (e.ajax.data = {});
        e.ajax.data.statuses = encodeURIComponent(
            JSON.stringify(a, function(a, b) {
                return b && b.nodeType ? null : b;
            })
        );
        jQuery
            .ajax(e.ajax)
            .done(function(c, d, f) {
                jQuery.isFunction(b) && b(c, a, d, f);
                jQuery.isFunction(e.serverOkCallback) &&
                    e.serverOkCallback(c, a, d, f);
            })
            .fail(function() {
                jQuery.isFunction(c) && c(a);
                jQuery.isFunction(e.serverErrorCallback) &&
                    e.serverErrorCallback(a);
            })
            .always(function() {
                jQuery.isFunction(f) && f(a);
            });
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.21 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    jQuery.fn.jplist.ui.controls.DatePickerRangeFilterDTO = function(
        d,
        g,
        h,
        e
    ) {
        d = {
            path: d,
            format: g,
            filterType: "dateRange",
            prev_year: "",
            prev_month: "",
            prev_day: "",
            next_year: "",
            next_month: "",
            next_day: ""
        };
        h &&
            ((d.prev_year = h.getFullYear()),
            (d.prev_month = h.getMonth()),
            (d.prev_day = h.getDate()));
        e &&
            ((d.next_year = e.getFullYear()),
            (d.next_month = e.getMonth()),
            (d.next_day = e.getDate()));
        return d;
    };
})();
(function() {
    var d = function(b) {
            var a = {},
                c,
                f;
            c = b.$control.find('[data-type="prev"]');
            f = b.$control.find('[data-type="next"]');
            b.$control.data("jplist-datepicker-range-prev", c);
            b.$control.data("jplist-datepicker-range-next", f);
            c.off("change").change(function() {
                "" === jQuery.trim(jQuery(this).val()) &&
                    (b.history.addStatus(g(b, !1)),
                    b.observer.trigger(
                        b.observer.events.unknownStatusesChanged,
                        [!1]
                    ));
            });
            f.off("change").change(function() {
                "" === jQuery.trim(jQuery(this).val()) &&
                    (b.history.addStatus(g(b, !1)),
                    b.observer.trigger(
                        b.observer.events.unknownStatusesChanged,
                        [!1]
                    ));
            });
            a.onSelect = function(a, c) {
                b.history.addStatus(g(b, !1));
                b.observer.trigger(b.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            };
            b.params.datepickerFunc(c, a);
            b.params.datepickerFunc(f, a);
            (a = c.attr("value")) && c.datepicker("setDate", a);
            (c = f.attr("value")) && f.datepicker("setDate", c);
        },
        g = function(b, a) {
            var c = null,
                f = (c = null),
                d = null,
                e;
            e = b.$control.attr("data-path").toString();
            c = b.$control.attr("data-datetime-format").toString();
            f = b.$control.data("jplist-datepicker-range-prev");
            d = b.$control.data("jplist-datepicker-range-next");
            f = f.datepicker("getDate");
            d = d.datepicker("getDate");
            c = new jQuery.fn.jplist.ui.controls.DatePickerRangeFilterDTO(
                e,
                c,
                f,
                d
            );
            return (c = new jQuery.fn.jplist.app.dto.StatusDTO(
                b.name,
                b.action,
                b.type,
                c,
                b.inStorage,
                b.inAnimation,
                b.isAnimateToTop,
                b.inDeepLinking
            ));
        },
        h = function(b, a, c) {
            b = c.split(b.options.delimiter2);
            3 === b.length &&
                ((a.data.prev_year = b[0]),
                (a.data.prev_month = b[1]),
                (a.data.prev_day = b[2]));
        },
        e = function(b, a, c) {
            b = c.split(b.options.delimiter2);
            3 === b.length &&
                ((a.data.next_year = b[0]),
                (a.data.next_month = b[1]),
                (a.data.next_day = b[2]));
        },
        a = function(b) {
            var a = b.$control.attr("data-datepicker-func");
            jQuery.isFunction(jQuery.fn.jplist.settings[a]) &&
                (b.params.datepickerFunc = jQuery.fn.jplist.settings[a]);
        },
        c = function(b) {
            b.params = { datepickerFunc: function() {} };
            a(b);
            d(b);
            return jQuery.extend(this, b);
        };
    c.prototype.getStatus = function(a) {
        return g(this, a);
    };
    c.prototype.getDeepLink = function() {
        var a = "",
            c,
            d,
            f;
        this.inDeepLinking &&
            ((c = g(this, !1)),
            c.data &&
                ((d =
                    jQuery.isNumeric(c.data.prev_year) &&
                    jQuery.isNumeric(c.data.prev_month) &&
                    jQuery.isNumeric(c.data.prev_day)),
                (f =
                    jQuery.isNumeric(c.data.next_year) &&
                    jQuery.isNumeric(c.data.next_month) &&
                    jQuery.isNumeric(c.data.next_day)),
                d || f)) &&
            ((a += this.name + this.options.delimiter0),
            d && (a += "prev"),
            f && (d && (a += this.options.delimiter2), (a += "next")),
            (a += "="),
            d &&
                (a +=
                    c.data.prev_year +
                    this.options.delimiter2 +
                    c.data.prev_month +
                    this.options.delimiter2 +
                    c.data.prev_day),
            f &&
                (d && (a += this.options.delimiter3),
                (a +=
                    c.data.next_year +
                    this.options.delimiter2 +
                    c.data.next_month +
                    this.options.delimiter2 +
                    c.data.next_day)));
        return a;
    };
    c.prototype.getStatusByDeepLink = function(a, c) {
        var d = null,
            f;
        if (
            this.inDeepLinking &&
            ((d = g(this, !0)),
            delete d.data.next_year,
            delete d.data.next_month,
            delete d.data.next_day,
            delete d.data.prev_year,
            delete d.data.prev_month,
            delete d.data.prev_day,
            d.data)
        )
            switch (a) {
                case "prev":
                    h(this, d, c);
                    break;
                case "next":
                    e(this, d, c);
                    break;
                case "prev~next":
                    (f = c.split(this.options.delimiter3)),
                        2 === f.length && (h(this, d, f[0]), e(this, d, f[1]));
            }
        return d;
    };
    c.prototype.getPaths = function(a) {
        var c;
        if ((c = this.$control.attr("data-path").toString()))
            (c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                c,
                "datetime"
            )),
                a.push(c);
    };
    c.prototype.setStatus = function(a, c) {
        var d, f, e;
        f = this.$control.data("jplist-datepicker-range-prev");
        e = this.$control.data("jplist-datepicker-range-next");
        jQuery.isNumeric(a.data.prev_year) &&
        jQuery.isNumeric(a.data.prev_month) &&
        jQuery.isNumeric(a.data.prev_day)
            ? ((d = new Date(
                  a.data.prev_year,
                  a.data.prev_month,
                  a.data.prev_day
              )),
              f.datepicker("setDate", d))
            : f.val("");
        jQuery.isNumeric(a.data.next_year) &&
        jQuery.isNumeric(a.data.next_month) &&
        jQuery.isNumeric(a.data.next_day)
            ? ((d = new Date(
                  a.data.next_year,
                  a.data.next_month,
                  a.data.next_day
              )),
              e.datepicker("setDate", d))
            : e.val("");
    };
    jQuery.fn.jplist.ui.controls.DatePickerRangeFilter = function(a) {
        return new c(a);
    };
    jQuery.fn.jplist.controlTypes["date-picker-range-filter"] = {
        className: "DatePickerRangeFilter",
        options: {}
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.DatePickerFilterDTO = function(d, g, h) {
        d = {
            path: d,
            format: g,
            filterType: "date",
            year: "",
            month: "",
            day: ""
        };
        h &&
            ((d.year = h.getFullYear()),
            (d.month = h.getMonth()),
            (d.day = h.getDate()));
        return d;
    };
})();
(function() {
    var d = function(a) {
            var c = {};
            a.$control.off("change").on("change", function() {
                var b;
                "" === jQuery.trim(jQuery(this).val()) &&
                    ((b = g(a, !1)),
                    a.history.addStatus(b),
                    a.observer.trigger(a.observer.events.statusChanged, [b]));
            });
            c.onSelect = function(b, c) {
                a.history.addStatus(g(a, !1));
                a.observer.trigger(a.observer.events.statusChanged, [g(a, !1)]);
            };
            a.params.datepickerFunc(a.$control, c);
        },
        g = function(a, c) {
            var b = null,
                b = (b = null);
            c || (b = a.$control.datepicker("getDate"));
            b = new jQuery.fn.jplist.ui.controls.DatePickerFilterDTO(
                a.params.dataPath,
                a.params.dateTimeFormat,
                b
            );
            return (b = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                b,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        h = function(a) {
            var c = a.$control.attr("data-datepicker-func");
            jQuery.isFunction(jQuery.fn.jplist.settings[c]) &&
                (a.params.datepickerFunc = jQuery.fn.jplist.settings[c]);
        },
        e = function(a) {
            a.params = {
                datepickerFunc: function() {},
                dataPath: a.$control.attr("data-path"),
                dateTimeFormat: a.$control.attr("data-datetime-format")
            };
            h(a);
            d(a);
            return jQuery.extend(this, a);
        };
    e.prototype.getStatus = function(a) {
        return g(this, a);
    };
    e.prototype.getDeepLink = function() {
        var a = "",
            c;
        this.inDeepLinking &&
            ((c = g(this, !1)),
            c.data &&
                jQuery.isNumeric(c.data.year) &&
                jQuery.isNumeric(c.data.month) &&
                jQuery.isNumeric(c.data.day) &&
                (a +=
                    this.name +
                    this.options.delimiter0 +
                    "date=" +
                    c.data.year +
                    this.options.delimiter2 +
                    c.data.month +
                    this.options.delimiter2 +
                    c.data.day));
        return a;
    };
    e.prototype.getStatusByDeepLink = function(a, c) {
        var b = null,
            d;
        this.inDeepLinking &&
            ((b = g(this, !0)),
            b.data &&
                "date" === a &&
                ((d = c.split(this.options.delimiter2)),
                3 === d.length &&
                    ((b.data.year = d[0]),
                    (b.data.month = d[1]),
                    (b.data.day = d[2]))));
        return b;
    };
    e.prototype.getPaths = function(a) {
        var c;
        this.params.dataPath &&
            ((c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                this.params.dataPath,
                "datetime"
            )),
            a.push(c));
    };
    e.prototype.setStatus = function(a, c) {
        var b;
        jQuery.isNumeric(a.data.year) &&
        jQuery.isNumeric(a.data.month) &&
        jQuery.isNumeric(a.data.day)
            ? ((b = new Date(a.data.year, a.data.month, a.data.day)),
              this.$control.datepicker("setDate", b))
            : this.$control.val("");
    };
    jQuery.fn.jplist.ui.controls.DatePickerFilter = function(a) {
        return new e(a);
    };
    jQuery.fn.jplist.controlTypes["date-picker-filter"] = {
        className: "DatePickerFilter",
        options: {}
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.RangeSliderDTO = function(d, g, h, e, a) {
        return {
            path: d,
            type: "number",
            filterType: "range",
            min: g,
            max: h,
            prev: e,
            next: a
        };
    };
})();
(function() {
    var d = function(a, c) {
            var b = null,
                d,
                e,
                f,
                b = a.params.$uiSlider.slider("option", "min");
            d = a.params.$uiSlider.slider("option", "max");
            c
                ? ((e = a.params.defaultPrev), (f = a.params.defaultNext))
                : ((e = a.params.$uiSlider.slider("values", 0)),
                  (f = a.params.$uiSlider.slider("values", 1)));
            b = new jQuery.fn.jplist.ui.controls.RangeSliderDTO(
                a.params.dataPath,
                b,
                d,
                e,
                f
            );
            return (b = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                b,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        g = function(a) {
            a.params.$uiSlider.on("slidechange", function(c, b) {
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        h = function(a) {
            var c = a.$control.attr("data-slider-func"),
                b = a.$control.attr("data-setvalues-func");
            jQuery.isFunction(jQuery.fn.jplist.settings[c]) &&
                (a.params.uiSliderFunc = jQuery.fn.jplist.settings[c]);
            jQuery.isFunction(jQuery.fn.jplist.settings[b]) &&
                (a.params.uiSetValuesFunc = jQuery.fn.jplist.settings[b]);
        },
        e = function(a) {
            a.params = {
                $uiSlider: a.$control.find('[data-type="ui-slider"]'),
                $prev: a.$control.find('[data-type="prev-value"]'),
                $next: a.$control.find('[data-type="next-value"]'),
                uiSliderFunc: function(a, b, d) {},
                uiSetValuesFunc: function(a, b, d) {},
                controlOptions: a.controlOptions,
                dataPath: a.$control.attr("data-path")
            };
            h(a);
            a.params.uiSliderFunc(
                a.params.$uiSlider,
                a.params.$prev,
                a.params.$next
            );
            a.params.uiSetValuesFunc(
                a.params.$uiSlider,
                a.params.$prev,
                a.params.$next
            );
            a.params.defaultPrev = a.params.$uiSlider.slider("values", 0);
            a.params.defaultNext = a.params.$uiSlider.slider("values", 1);
            g(a);
            return jQuery.extend(this, a);
        };
    e.prototype.getStatus = function(a) {
        return d(this, a);
    };
    e.prototype.getDeepLink = function() {
        var a = "",
            c;
        this.inDeepLinking &&
            ((c = d(this, !1)),
            c.data &&
                jQuery.isNumeric(c.data.prev) &&
                jQuery.isNumeric(c.data.next) &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "prev" +
                    this.options.delimiter2 +
                    "next=" +
                    c.data.prev +
                    this.options.delimiter2 +
                    c.data.next));
        return a;
    };
    e.prototype.getStatusByDeepLink = function(a, c) {
        var b = null,
            e;
        this.inDeepLinking &&
            ((b = d(this, !0)),
            b.data &&
                a === "prev" + this.options.delimiter2 + "next" &&
                ((e = c.split(this.options.delimiter2)),
                2 === e.length &&
                    ((b.data.prev = e[0]), (b.data.next = e[1]))));
        return b;
    };
    e.prototype.getPaths = function(a) {
        var c;
        this.params.dataPath &&
            ((c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                this.params.dataPath,
                "number"
            )),
            a.push(c));
    };
    e.prototype.setStatus = function(a, c) {
        var b, d;
        jQuery.isNumeric(a.data.prev) &&
            jQuery.isNumeric(a.data.next) &&
            ((b = Number(a.data.prev)),
            (d = Number(a.data.next)),
            isNaN(b) ||
                isNaN(d) ||
                (this.params.$uiSlider.slider("values", 0) != b &&
                    this.params.$uiSlider.slider("values", 0, b),
                this.params.$uiSlider.slider("values", 1) != d &&
                    this.params.$uiSlider.slider("values", 1, d)));
        this.params.controlOptions &&
            this.params.uiSetValuesFunc(
                this.params.$uiSlider,
                this.params.$prev,
                this.params.$next
            );
    };
    jQuery.fn.jplist.ui.controls.RangeSlider = function(a) {
        return new e(a);
    };
    jQuery.fn.jplist.controlTypes["range-slider"] = {
        className: "RangeSlider",
        options: {}
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.71 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var f = function(f) {
        return jQuery.extend(this, f);
    };
    f.prototype.setStatus = function(f, d) {
        var b, a;
        b = f.data.paging;
        !b || 0 >= b.pagesNumber
            ? (this.$control.html(""), this.$control.addClass("jplist-empty"))
            : (this.$control.removeClass("jplist-empty"),
              (a = this.$control.attr("data-type")),
              (a = a.replace("{current}", b.currentPage + 1)),
              (a = a.replace("{pages}", b.pagesNumber)),
              (a = a.replace("{start}", b.start + 1)),
              (a = a.replace("{end}", b.end)),
              (a = a.replace("{all}", b.itemsNumber)),
              this.$control.html(a));
    };
    jQuery.fn.jplist.ui.controls.PaginationInfo = function(g) {
        return new f(g);
    };
    jQuery.fn.jplist.controlTypes["pagination-info"] = {
        className: "PaginationInfo",
        options: {}
    };
})();
(function() {
    var f = function(b, a) {
            var e;
            e = null;
            var c;
            c = !1;
            e = b.$control.find("button[data-active]").eq(0);
            0 >= e.length && (e = b.$control.find("button").eq(0));
            e = a ? 0 : Number(e.attr("data-number")) || 0;
            (c =
                "true" === b.$control.attr("data-jump-to-start") ||
                b.controlOptions.jumpToStart) &&
                (c = b.history.getLastStatus()) &&
                "pagination" !== c.type &&
                "views" !== c.type &&
                (e = 0);
            c = Number(b.$control.attr("data-items-per-page")) || 0;
            e = new jQuery.fn.jplist.ui.controls.PaginationDTO(e, c);
            return (e = new jQuery.fn.jplist.app.dto.StatusDTO(
                b.name,
                b.action,
                b.type,
                e,
                b.inStorage,
                b.inAnimation,
                b.isAnimateToTop,
                b.inDeepLinking
            ));
        },
        g = function(b) {
            b.$control.on("click", "button", function() {
                var a,
                    e = null;
                a = jQuery(this);
                var c;
                a = Number(a.attr("data-number")) || 0;
                e = f(b, !1);
                e.data.currentPage = a;
                c = b.$root.find('[data-control-type="pagination"]');
                c.find("button").removeAttr("data-active");
                c.find('button[data-number="' + a + '"]').each(function() {
                    jQuery(this).attr("data-active", !0);
                });
                b.observer.trigger(b.observer.events.statusChanged, [e]);
            });
        },
        d = function(b) {
            b.params = {
                view: new jQuery.fn.jplist.ui.controls.PaginationView(
                    b.$control,
                    b.controlOptions
                )
            };
            g(b);
            return jQuery.extend(this, b);
        };
    d.prototype.getStatus = function(b) {
        return f(this, b);
    };
    d.prototype.getDeepLink = function() {
        var b = "",
            a;
        this.inDeepLinking &&
            ((a = f(this, !1)),
            a.data &&
                (jQuery.isNumeric(a.data.currentPage) &&
                    (b =
                        this.name +
                        this.options.delimiter0 +
                        "currentPage=" +
                        a.data.currentPage),
                jQuery.isNumeric(a.data.number) &&
                    (b && (b += this.options.delimiter1),
                    (b +=
                        this.name +
                        this.options.delimiter0 +
                        "number=" +
                        a.data.number))));
        return b;
    };
    d.prototype.getStatusByDeepLink = function(b, a) {
        var e;
        a: if (((e = null), this.inDeepLinking)) {
            if ("currentPage" !== b) {
                e = null;
                break a;
            }
            e = f(this, !0);
            e.data && "currentPage" === b && (e.data.currentPage = a);
        }
        return e;
    };
    d.prototype.setStatus = function(b, a) {
        b.data && b.data.paging && this.params.view.build(b.data.paging);
    };
    jQuery.fn.jplist.ui.controls.Pagination = function(b) {
        return new d(b);
    };
    jQuery.fn.jplist.controlTypes.pagination = {
        className: "Pagination",
        options: {}
    };
})();
(function() {
    var f = function(d, b, a) {
            var e;
            e = '<div class="jplist-pagesbox" data-type="pagesbox">';
            for (var c = d; c < b; c++)
                (e += '<button type="button" data-type="page" '),
                    c === a &&
                        (e += ' class="jplist-current" data-active="true" '),
                    (d = c + 1),
                    (e += ' data-number="' + c + '" '),
                    (e += ">" + d + "</button> ");
            return e + "</div>";
        },
        g = function(d, b) {
            var a = {
                    $control: d,
                    options: b,
                    $pagingprev: null,
                    $pagingmid: null,
                    $pagingnext: null,
                    $jplistFirst: null,
                    $jplistPrev: null,
                    $jplistNext: null,
                    $jplistLast: null,
                    mode: d.attr("data-mode")
                },
                e,
                c,
                f,
                h;
            e = a.$control.attr("data-prev") || a.options.prevArrow;
            c = a.$control.attr("data-next") || a.options.nextArrow;
            f = a.$control.attr("data-first") || a.options.firstArrow;
            h = a.$control.attr("data-last") || a.options.lastArrow;
            a.$control.html(
                '<div class="jplist-pagingprev" data-type="pagingprev"></div><div class="jplist-pagingmid" data-type="pagingmid"></div><div class="jplist-pagingnext" data-type="pagingnext"></div>'
            );
            a.$pagingprev = a.$control.find('[data-type="pagingprev"]');
            a.$pagingmid = a.$control.find('[data-type="pagingmid"]');
            a.$pagingnext = a.$control.find('[data-type="pagingnext"]');
            a.$pagingprev.html(
                '<button type="button" class="jplist-first" data-number="0" data-type="first">' +
                    f +
                    '</button><button type="button" class="jplist-prev" data-type="prev">' +
                    e +
                    "</button>"
            );
            a.$pagingnext.html(
                '<button type="button" class="jplist-next" data-type="next">' +
                    c +
                    '</button><button type="button" class="jplist-last" data-type="last">' +
                    h +
                    "</button>"
            );
            a.$jplistFirst = a.$pagingprev.find('[data-type="first"]');
            a.$jplistPrev = a.$pagingprev.find('[data-type="prev"]');
            a.$jplistNext = a.$pagingnext.find('[data-type="next"]');
            a.$jplistLast = a.$pagingnext.find('[data-type="last"]');
            return jQuery.extend(this, a);
        };
    g.prototype.build = function(d) {
        if (0 <= d.currentPage && d.currentPage < d.pagesNumber) {
            this.$control.removeClass("jplist-hidden");
            switch (this.mode) {
                case "google-like":
                    var b = "",
                        a;
                    a =
                        Number(this.$control.attr("data-range")) ||
                        this.options.range;
                    b = d.currentPage - Math.floor((a - 1) / 2);
                    0 > b && (b = 0);
                    a = b + a;
                    a > d.pagesNumber && (a = d.pagesNumber);
                    b = f(b, a, d.currentPage);
                    this.$pagingmid.html(b);
                    break;
                default:
                    var e;
                    e =
                        Number(this.$control.attr("data-range")) ||
                        this.options.range;
                    a = Math.floor(d.currentPage / e);
                    b = e * (a + 1);
                    b > d.pagesNumber && (b = d.pagesNumber);
                    b = f(e * a, b, d.currentPage);
                    this.$pagingmid.html(b);
            }
            this.$jplistPrev
                .attr("data-number", d.prevPage)
                .removeClass("jplist-current");
            this.$jplistNext
                .attr("data-number", d.nextPage)
                .removeClass("jplist-current");
            this.$jplistLast
                .attr("data-number", d.pagesNumber - 1)
                .removeClass("jplist-current");
            1 >= d.pagesNumber
                ? this.$control.addClass("jplist-one-page")
                : this.$control.removeClass("jplist-one-page");
        } else this.$control.addClass("jplist-hidden");
        0 === d.currentPage
            ? this.$pagingprev.addClass("not-active")
            : this.$pagingprev.removeClass("not-active");
        d.currentPage == d.pagesNumber - 1
            ? this.$pagingnext.addClass("not-active")
            : this.$pagingnext.removeClass("not-active");
    };
    jQuery.fn.jplist.ui.controls.PaginationView = function(d, b) {
        return new g(d, b);
    };
    jQuery.fn.jplist.controlTypes.pagination = {
        className: "Pagination",
        options: {
            range: 7,
            jumpToStart: !1,
            prevArrow: "&lsaquo;",
            nextArrow: "&rsaquo;",
            firstArrow: "&laquo;",
            lastArrow: "&raquo;"
        }
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.PaginationDTO = function(f, g) {
        var d = {
            currentPage: f,
            paging: null
        };
        g && (d.number = g);
        return d;
    };
})();
(function() {
    var f = function(a, b) {
            var c = null;
            b
                ? ((c = a.$control
                      .find('li:has(span[data-default="true"])')
                      .eq(0)),
                  0 >= c.length && (c = a.$control.find("li:eq(0)")))
                : (c = a.$control.find(".active"));
            c = c.find("span");
            c = new jQuery.fn.jplist.ui.controls.DropdownPaginationDTO(
                c.attr("data-number")
            );
            return (c = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                c,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        g = function(a, b) {
            var c, d, f;
            a.$control.find("span").each(function() {
                c = jQuery(this).attr("data-path");
                d = jQuery(this).attr("data-type");
                c &&
                    "" !== jQuery.trim(c) &&
                    ((f = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        c,
                        d
                    )),
                    b.push(f));
            });
        },
        d = function(a) {
            a.$control
                .find("li")
                .off()
                .on("click", function() {
                    var b, c, d, g;
                    b = f(a, !1);
                    g = jQuery(this).find("span");
                    c = g.attr("data-path");
                    d = g.attr("data-number");
                    c
                        ? ((b.data.path = c),
                          (b.data.type = g.attr("data-type")),
                          (b.data.order = g.attr("data-order")))
                        : d && (b.data.number = d);
                    a.observer.trigger(a.observer.events.statusChanged, [b]);
                });
        },
        b = function(a) {
            new jQuery.fn.jplist.ui.panel.DropdownControl(
                a.options,
                a.observer,
                a.history,
                a.$control
            );
            d(a);
            return jQuery.extend(this, a);
        };
    b.prototype.getStatus = function(a) {
        return f(this, a);
    };
    b.prototype.getDeepLink = function() {
        var a = "",
            b;
        this.inDeepLinking &&
            ((b = f(this, !1)),
            b.data &&
                (jQuery.isNumeric(b.data.number) || "all" === b.data.number) &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "number=" +
                    b.data.number));
        return a;
    };
    b.prototype.getStatusByDeepLink = function(a, b) {
        var c;
        a: if (((c = null), this.inDeepLinking)) {
            if (
                "number" !== a &&
                a !==
                    "path" +
                        this.options.delimiter2 +
                        "type" +
                        this.options.delimiter2 +
                        "order" &&
                "path" !== a
            ) {
                c = null;
                break a;
            }
            c = f(this, !0);
            c.data &&
                "number" === a &&
                jQuery.isNumeric(c.data.number) &&
                (c.data.number = b);
        }
        return c;
    };
    b.prototype.getPaths = function(a) {
        g(this, a);
    };
    b.prototype.setStatus = function(a, b) {
        var c, d;
        d = this.$control.find("li");
        d.removeClass("active");
        c = this.$control.find('li:has([data-number="' + a.data.number + '"])');
        0 === c.length &&
            (c = this.$control.find('li:has([data-number="all"])'));
        0 >= c.length && (c = d.eq(0));
        c.addClass("active");
        this.$control.find(".jplist-dd-panel").text(c.eq(0).text());
    };
    jQuery.fn.jplist.ui.controls.ItemsPerPageDropdown = function(a) {
        return new b(a);
    };
    jQuery.fn.jplist.controlTypes["items-per-page-drop-down"] = {
        className: "ItemsPerPageDropdown",
        options: {},
        dropdown: !0
    };
})();
(function() {
    var f = function(a, b) {
            var c;
            c = null;
            b
                ? ((c = a.$control.find('option[data-default="true"]').eq(0)),
                  0 >= c.length && (c = a.$control.find("option").eq(0)))
                : (c = a.$control.find("option:selected"));
            c = new jQuery.fn.jplist.ui.controls.DropdownPaginationDTO(
                c.attr("data-number")
            );
            return (c = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                c,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        g = function(a, b) {
            var c, d, f;
            a.$control.find("option").each(function() {
                c = jQuery(this).attr("data-path");
                d = jQuery(this).attr("data-type");
                c &&
                    ((f = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        c,
                        d
                    )),
                    b.push(f));
            });
        },
        d = function(a) {
            a.$control.change(function() {
                var b, c, d;
                b = f(a, !1);
                c = jQuery(this).find("option:selected");
                d = c.attr("data-path");
                c = c.attr("data-number");
                d
                    ? ((b.data.path = d),
                      (b.data.type = jQuery(this).attr("data-type")),
                      (b.data.order = jQuery(this).attr("data-order")))
                    : c && (b.data.number = c);
                a.observer.trigger(a.observer.events.statusChanged, [b]);
            });
        },
        b = function(a) {
            d(a);
            return jQuery.extend(this, a);
        };
    b.prototype.getStatus = function(a) {
        return f(this, a);
    };
    b.prototype.getDeepLink = function() {
        var a = "",
            b;
        this.inDeepLinking &&
            ((b = f(this, !1)),
            b.data &&
                jQuery.isNumeric(b.data.number) &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "number=" +
                    b.data.number));
        return a;
    };
    b.prototype.getStatusByDeepLink = function(a, b) {
        var c = null;
        this.inDeepLinking &&
            ((c = f(this, !0)),
            c.data &&
                "number" === a &&
                jQuery.isNumeric(c.data.number) &&
                (c.data.number = b));
        return c;
    };
    b.prototype.getPaths = function(a) {
        g(this, a);
    };
    b.prototype.setStatus = function(a, b) {
        var c;
        c = this.$control.find('option[data-number="' + a.data.number + '"]');
        0 === c.length && (c = this.$control.find('option[data-number="all"]'));
        c.get(0).selected = !0;
    };
    jQuery.fn.jplist.ui.controls.ItemsPerPageSelect = function(a) {
        return new b(a);
    };
    jQuery.fn.jplist.controlTypes["items-per-page-select"] = {
        className: "ItemsPerPageSelect",
        options: {}
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.DropdownPaginationDTO = function(f) {
        return {
            number: f
        };
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.6 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var d = function(a, c) {
            var b,
                h = [],
                d,
                e,
                f;
            b = a.$control.data("storage-status");
            (c && b) ||
                a.params.$buttons.each(function(a, k) {
                    d = jQuery(k);
                    (f = c
                        ? "true" === d.attr("data-selected")
                        : d.data("selected") || !1) &&
                        (e = d.attr("data-path")) &&
                        h.push(e);
                });
            return (b = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                { pathGroup: h, filterType: "pathGroup" },
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        f = function(a, c) {
            var b, d;
            a.params.$buttons.each(function(a, k) {
                if ((b = jQuery(k).attr("data-path")))
                    (d = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        b,
                        "text"
                    )),
                        c.push(d);
            });
        },
        e = function(a, c, b) {
            var d;
            a.params.$buttons.each(function(a, c) {
                d = jQuery(c);
                d.removeClass("jplist-selected");
                d.data("selected", !1);
            });
            if (
                c.data &&
                c.data.pathGroup &&
                jQuery.isArray(c.data.pathGroup) &&
                0 < c.data.pathGroup.length
            )
                for (var e = 0; e < c.data.pathGroup.length; e++)
                    (b = c.data.pathGroup[e]),
                        (d = a.params.$buttons.filter(
                            '[data-path="' + b + '"]'
                        )),
                        0 < d.length &&
                            (d.addClass("jplist-selected"),
                            d.data("selected", !0));
        },
        a = function(a) {
            a.params.$buttons.on("click", function() {
                var c, b;
                c = jQuery(this);
                "multiple" === a.params.mode
                    ? ((b = c.data("selected") || !1), c.data("selected", !b))
                    : (a.params.$buttons.data("selected", !1),
                      c.data("selected", !0));
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        b = function(a) {
            var c;
            "multiple" === a.params.mode
                ? a.params.$buttons.each(function() {
                      var c = jQuery(this),
                          b;
                      b = "true" === c.attr("data-selected");
                      a.options.deepLinking && (b = !1);
                      c.data("selected", b);
                  })
                : (a.params.$buttons.data("selected", !1),
                  (c = a.params.$buttons.filter('[data-selected="true"]')),
                  (c = 0 < c.length ? c.eq(0) : a.params.$buttons.eq(0)),
                  c.data("selected", !0),
                  c.attr("data-selected", !0),
                  c.trigger("click"));
        },
        c = function(c) {
            c.params = {
                $buttons: c.$control.find("[data-button]"),
                mode: c.$control.attr("data-mode") || "multiple"
            };
            a(c);
            b(c);
            return jQuery.extend(this, c);
        };
    c.prototype.getStatus = function(a) {
        return d(this, a);
    };
    c.prototype.getDeepLink = function() {
        var a = "",
            c = "",
            b;
        if (
            this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data && b.data.pathGroup && 0 < b.data.pathGroup.length)
        ) {
            for (var e = 0; e < b.data.pathGroup.length; e++)
                (a = b.data.pathGroup[e]),
                    0 < e && (c += this.options.delimiter2),
                    (c += a);
            a = this.name + this.options.delimiter0 + "selected=" + c;
        }
        return a;
    };
    c.prototype.getStatusByDeepLink = function(a, c) {
        var b = null;
        this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                "selected" === a &&
                (b.data.pathGroup = c.split(this.options.delimiter2)));
        return b;
    };
    c.prototype.getPaths = function(a) {
        f(this, a);
    };
    c.prototype.setStatus = function(a, c) {
        e(this, a, c);
    };
    jQuery.fn.jplist.ui.controls.ButtonFilterGroup = function(a) {
        return new c(a);
    };
    jQuery.fn.jplist.controlTypes["button-filter-group"] = {
        className: "ButtonFilterGroup",
        options: {}
    };
})();
(function() {
    var d = function(a, b) {
            var c,
                k = "";
            (c = b
                ? "true" === a.$control.attr("data-selected")
                : a.params.selected) && (k = "path");
            c = {
                path: a.$control.attr("data-path"),
                filterType: k,
                selected: c
            };
            return new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                c,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            );
        },
        f = function(a) {
            a.$control.on("click", function() {
                a.params.selected = !a.params.selected;
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        e = function(a) {
            a.params = {
                selected: "true" === a.$control.attr("data-selected")
            };
            a.options.deepLinking && (a.params.selected = !1);
            f(a);
            return jQuery.extend(this, a);
        };
    e.prototype.getStatus = function(a) {
        return d(this, a);
    };
    e.prototype.getDeepLink = function() {
        var a = "",
            b = null;
        this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                b.data.selected &&
                (a = this.name + this.options.delimiter0 + "selected=true"));
        return a;
    };
    e.prototype.getStatusByDeepLink = function(a, b) {
        var c = null,
            k;
        this.inDeepLinking &&
            ((c = d(this, !1)),
            c.data && (k = "selected" === a && "true" === b)) &&
            ((c.data.selected = k), (c.data.filterType = "path"));
        return c;
    };
    e.prototype.getPaths = function(a) {
        var b;
        if ((b = this.$control.attr("data-path")))
            (b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                b,
                "text"
            )),
                a.push(b);
    };
    e.prototype.setStatus = function(a, b) {
        (this.params.selected = a.data.selected)
            ? this.$control.addClass("jplist-selected")
            : this.$control.removeClass("jplist-selected");
    };
    jQuery.fn.jplist.ui.controls.ButtonFilter = function(a) {
        return new e(a);
    };
    jQuery.fn.jplist.controlTypes["button-filter"] = {
        className: "ButtonFilter",
        options: {}
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.ButtonTextFilterDTO = function(d, f, e, a, b) {
        return {
            path: d,
            ignore: e,
            value: f,
            selected: a,
            mode: b,
            filterType: "TextFilter"
        };
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.ButtonTextFilterGroupDTO = function(d, f) {
        return {
            textAndPathsGroup: d,
            ignore: f,
            filterType: "textFilterPathGroup"
        };
    };
})();
(function() {
    var d = function(a, b) {
            var g,
                d = [];
            g = null;
            g = "";
            a.controlOptions &&
                a.controlOptions.ignore &&
                (g = a.controlOptions.ignore);
            a.params.$buttons.each(function(a, c) {
                var g = jQuery(c),
                    e;
                e = b
                    ? "true" === g.attr("data-selected")
                    : g.data("selected") || !1;
                d.push({
                    selected: e,
                    text: g.data("dataText"),
                    path: g.data("dataPath"),
                    mode: g.data("dataMode") || "contains"
                });
            });
            g = new jQuery.fn.jplist.ui.controls.ButtonTextFilterGroupDTO(d, g);
            return (g = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                g,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        f = function(a, b) {
            var g, d, e;
            a.params.$buttons.each(function(a, c) {
                g = jQuery(this);
                if ((d = g.attr("data-path")))
                    (e = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        d,
                        "text"
                    )),
                        b.push(e);
            });
        },
        e = function(a, b, g) {
            var d;
            a.params.$buttons.each(function(a, c) {
                d = jQuery(c);
                d.removeClass("jplist-selected");
                d.data("selected", !1);
            });
            if (
                b.data &&
                b.data.textAndPathsGroup &&
                jQuery.isArray(b.data.textAndPathsGroup) &&
                0 < b.data.textAndPathsGroup.length
            )
                for (var e = 0; e < b.data.textAndPathsGroup.length; e++)
                    (g = b.data.textAndPathsGroup[e]),
                        (d = a.params.$buttons.filter(
                            '[data-path="' +
                                g.path +
                                '"][data-text="' +
                                g.text +
                                '"]'
                        )),
                        0 < d.length &&
                            g.selected &&
                            (d.addClass("jplist-selected"),
                            d.data("selected", !0));
        },
        a = function(a) {
            var b;
            a.params.$buttons.on("click", function() {
                var g = jQuery(this);
                b = g.data("selected") || !1;
                g.data("selected", !b);
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        b = function(c) {
            c.params = { $buttons: c.$control.find("[data-button]") };
            c.params.$buttons.each(function() {
                var a = jQuery(this),
                    b;
                b = "true" === a.attr("data-selected");
                c.options.deepLinking && (b = !1);
                a.data("selected", b);
                a.data("dataPath", a.attr("data-path"));
                a.data("dataText", a.attr("data-text"));
                a.data("dataMode", a.attr("data-mode") || "contains");
            });
            a(c);
            return jQuery.extend(this, c);
        };
    b.prototype.getStatus = function(a) {
        return d(this, a);
    };
    b.prototype.getDeepLink = function() {
        var a = "",
            b,
            g,
            e = [];
        if (
            this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                b.data.textAndPathsGroup &&
                0 < b.data.textAndPathsGroup.length)
        ) {
            for (var h = 0; h < b.data.textAndPathsGroup.length; h++)
                (g = b.data.textAndPathsGroup[h]),
                    g.selected &&
                        e.push(g.text + this.options.delimiter3 + g.path);
            0 < e.length &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "selected=" +
                    e.join(this.options.delimiter2));
        }
        return a;
    };
    b.prototype.getStatusByDeepLink = function(a, b) {
        var g = null,
            e,
            h;
        if (
            this.inDeepLinking &&
            ((g = d(this, !1)), g.data && "selected" === a)
        ) {
            g.data.textAndPathsGroup = [];
            e = b.split(this.options.delimiter2);
            for (var f = 0; f < e.length; f++)
                (h = e[f].split(this.options.delimiter3)),
                    2 === h.length &&
                        g.data.textAndPathsGroup.push({
                            selected: !0,
                            text: h[0],
                            path: h[1]
                        });
        }
        return g;
    };
    b.prototype.getPaths = function(a) {
        f(this, a);
    };
    b.prototype.setStatus = function(a, b) {
        e(this, a, b);
    };
    jQuery.fn.jplist.ui.controls.ButtonTextFilterGroup = function(a) {
        return new b(a);
    };
    jQuery.fn.jplist.controlTypes["button-text-filter-group"] = {
        className: "ButtonTextFilterGroup",
        options: { ignore: "[~!@#$%^&*()+=`'\"/\\_]+" }
    };
})();
(function() {
    var d = function(a, b) {
            var c;
            c = null;
            var d = "",
                g = "";
            a.controlOptions &&
                a.controlOptions.ignore &&
                (d = a.controlOptions.ignore);
            g = (c = b
                ? "true" === a.$control.attr("data-selected")
                : a.params.selected)
                ? a.params.dataText
                : "";
            c = new jQuery.fn.jplist.ui.controls.ButtonTextFilterDTO(
                a.params.dataPath,
                g,
                d,
                c,
                a.params.dataMode || "contains"
            );
            return (c = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                c,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        f = function(a) {
            a.$control.on("click", function() {
                a.params.selected = !a.params.selected;
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        e = function(a) {
            a.params = {
                selected: "true" === a.$control.attr("data-selected"),
                dataPath: a.$control.attr("data-path"),
                dataText: a.$control.attr("data-text"),
                dataMode: a.$control.attr("data-mode")
            };
            a.options.deepLinking && (a.params.selected = !1);
            f(a);
            return jQuery.extend(this, a);
        };
    e.prototype.getStatus = function(a) {
        return d(this, a);
    };
    e.prototype.getDeepLink = function() {
        var a = "",
            b;
        this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                b.data.selected &&
                (a = this.name + this.options.delimiter0 + "selected=true"));
        return a;
    };
    e.prototype.getStatusByDeepLink = function(a, b) {
        var c = null,
            e;
        this.inDeepLinking &&
            ((c = d(this, !1)),
            c.data && (e = "selected" === a && "true" === b)) &&
            ((c.data.selected = e), (c.data.value = this.params.dataText));
        return c;
    };
    e.prototype.getPaths = function(a) {
        var b;
        this.params.dataPath &&
            ((b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                this.params.dataPath,
                "text"
            )),
            a.push(b));
    };
    e.prototype.setStatus = function(a, b) {
        (this.params.selected = a.data.selected)
            ? this.$control.addClass("jplist-selected")
            : this.$control.removeClass("jplist-selected");
    };
    jQuery.fn.jplist.ui.controls.ButtonTextFilter = function(a) {
        return new e(a);
    };
    jQuery.fn.jplist.controlTypes["button-text-filter"] = {
        className: "ButtonTextFilter",
        options: { ignore: "[~!@#$%^&*()+=`'\"/\\_]+" }
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.CheckboxGroupFilterDTO = function(d) {
        return { pathGroup: d, filterType: "pathGroup" };
    };
})();
(function() {
    var d = function(a, b) {
            var d,
                e = [];
            d = null;
            var f;
            a.params.$checkboxes.each(function(a, c) {
                var d = jQuery(c);
                f = b ? d.data("selected-on-start") || !1 : d.get(0).checked;
                d = d.attr("data-path");
                f && d && e.push(d);
            });
            d = new jQuery.fn.jplist.ui.controls.CheckboxGroupFilterDTO(e);
            return (d = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                d,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        f = function(a, b) {
            a.params.$checkboxes.each(function(a, c) {
                var d;
                if ((d = jQuery(this).attr("data-path")))
                    (d = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        d,
                        "text"
                    )),
                        b.push(d);
            });
        },
        e = function(a, b, d) {
            var e;
            a.params.$checkboxes.each(function(a, b) {
                e = jQuery(b);
                e.removeClass("jplist-selected");
                e.get(0).checked = !1;
            });
            if (
                b.data &&
                b.data.pathGroup &&
                jQuery.isArray(b.data.pathGroup) &&
                0 < b.data.pathGroup.length
            )
                for (var f = 0; f < b.data.pathGroup.length; f++)
                    (d = b.data.pathGroup[f]),
                        (e = a.params.$checkboxes.filter(
                            '[data-path="' + d + '"]'
                        )),
                        0 < e.length &&
                            (e.addClass("jplist-selected"),
                            (e.get(0).checked = !0));
        },
        a = function(a) {
            a.params.$checkboxes.on("change", function() {
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        b = function(b) {
            b.params = { $checkboxes: b.$control.find("[data-path]") };
            b.params.$checkboxes.each(function() {
                var a = jQuery(this),
                    d;
                d = a.get(0).checked;
                b.options.deepLinking && (d = !1);
                a.data("selected-on-start", d);
                a.data("mode", a.attr("data-mode") || "contains");
            });
            a(b);
            return jQuery.extend(this, b);
        };
    b.prototype.getStatus = function(a) {
        return d(this, a);
    };
    b.prototype.getDeepLink = function() {
        var a = "",
            b,
            e = "";
        if (
            this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                jQuery.isArray(b.data.pathGroup) &&
                0 < b.data.pathGroup.length)
        ) {
            for (a = 0; a < b.data.pathGroup.length; a++)
                "" !== e && (e += this.options.delimiter2),
                    (e += b.data.pathGroup[a]);
            a = this.name + this.options.delimiter0 + "pathGroup=" + e;
        }
        return a;
    };
    b.prototype.getStatusByDeepLink = function(a, b) {
        var e = null,
            f;
        this.inDeepLinking &&
            ((e = d(this, !0)),
            e.data &&
                "pathGroup" === a &&
                ((f = b.split(this.options.delimiter2)),
                0 < f.length && (e.data.pathGroup = f)));
        return e;
    };
    b.prototype.getPaths = function(a) {
        f(this, a);
    };
    b.prototype.setStatus = function(a, b) {
        e(this, a, b);
    };
    jQuery.fn.jplist.ui.controls.CheckboxGroupFilter = function(a) {
        return new b(a);
    };
    jQuery.fn.jplist.controlTypes["checkbox-group-filter"] = {
        className: "CheckboxGroupFilter",
        options: {}
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.CheckboxTextFilterDTO = function(
        d,
        f,
        e,
        a,
        b
    ) {
        return {
            textGroup: d,
            logic: f,
            path: e,
            ignoreRegex: a,
            mode: b,
            filterType: "textGroup"
        };
    };
})();
(function() {
    var d = function(a, c) {
            var d,
                e = [];
            d = null;
            var f;
            a.params.$checkboxes.each(function(a, b) {
                var d = jQuery(b);
                f = c ? d.data("selected-on-start") || !1 : d.get(0).checked;
                (d = d.val()) && f && e.push(d);
            });
            d = new jQuery.fn.jplist.ui.controls.CheckboxTextFilterDTO(
                e,
                a.params.dataLogic,
                a.params.dataPath,
                a.params.ignore
            );
            return (d = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                d,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        f = function(a, c, d) {
            var e;
            a.params.$checkboxes.each(function(a, b) {
                e = jQuery(b);
                e.removeClass("jplist-selected");
                e.get(0).checked = !1;
            });
            if (
                c.data &&
                c.data.textGroup &&
                jQuery.isArray(c.data.textGroup) &&
                0 < c.data.textGroup.length
            )
                for (var f = 0; f < c.data.textGroup.length; f++)
                    (d = c.data.textGroup[f]),
                        (e = a.params.$checkboxes.filter(
                            '[value="' + d + '"]'
                        )),
                        0 < e.length &&
                            (e.addClass("jplist-selected"),
                            (e.get(0).checked = !0));
        },
        e = function(a) {
            a.params.$checkboxes.on("change", function() {
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        a = function(a) {
            a.params = {
                $checkboxes: a.$control.find('input[type="checkbox"]'),
                dataPath: a.$control.attr("data-path"),
                dataLogic: a.$control.attr("data-logic") || "or",
                ignore: ""
            };
            a.controlOptions &&
                a.controlOptions.ignore &&
                (a.params.ignore = a.controlOptions.ignore);
            a.params.$checkboxes.each(function() {
                var c = jQuery(this),
                    d;
                d = c.get(0).checked;
                a.options.deepLinking && (d = !1);
                c.data("selected-on-start", d);
            });
            e(a);
            return jQuery.extend(this, a);
        };
    a.prototype.getStatus = function(a) {
        return d(this, a);
    };
    a.prototype.getDeepLink = function() {
        var a = "",
            c,
            e = "";
        if (
            this.inDeepLinking &&
            ((c = d(this, !1)),
            c.data &&
                jQuery.isArray(c.data.textGroup) &&
                0 < c.data.textGroup.length)
        ) {
            for (a = 0; a < c.data.textGroup.length; a++)
                "" !== e && (e += this.options.delimiter2),
                    (e += c.data.textGroup[a]);
            a = this.name + this.options.delimiter0 + "textGroup=" + e;
        }
        return a;
    };
    a.prototype.getStatusByDeepLink = function(a, c) {
        var e = null,
            f;
        this.inDeepLinking &&
            ((e = d(this, !0)),
            e.data &&
                "textGroup" === a &&
                ((f = c.split(this.options.delimiter2)),
                0 < f.length && (e.data.textGroup = f)));
        return e;
    };
    a.prototype.getPaths = function(a) {
        var c;
        this.params.dataPath &&
            ((c = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                this.params.dataPath,
                "text"
            )),
            a.push(c));
    };
    a.prototype.setStatus = function(a, c) {
        f(this, a, c);
    };
    jQuery.fn.jplist.ui.controls.CheckboxTextFilter = function(b) {
        return new a(b);
    };
    jQuery.fn.jplist.controlTypes["checkbox-text-filter"] = {
        className: "CheckboxTextFilter",
        options: { ignore: "" }
    };
})();
(function() {
    var d = function(a, b) {
            var c = null,
                d;
            d = b ? a.params.initialSelected || !1 : a.$control.get(0).checked;
            c = {
                path: a.$control.attr("data-path"),
                type: "TextFilter",
                filterType: "path",
                selected: d
            };
            d || (c.filterType = "");
            return (c = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                c,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        f = function(a) {
            a.$control.on("change", function() {
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        e = function(a) {
            a.params = { initialSelected: a.$control.get(0).checked || !1 };
            f(a);
            return jQuery.extend(this, a);
        };
    e.prototype.getStatus = function(a) {
        return d(this, a);
    };
    e.prototype.getDeepLink = function() {
        var a = "",
            b;
        this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                b.data.selected &&
                (a = this.name + this.options.delimiter0 + "selected=true"));
        return a;
    };
    e.prototype.getStatusByDeepLink = function(a, b) {
        var c = null;
        this.inDeepLinking &&
            ((c = d(this, !0)),
            c.data && "selected" === a && (c.data.selected = !0));
        return c;
    };
    e.prototype.getPaths = function(a) {
        var b;
        if ((b = this.$control.attr("data-path")))
            (b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                b,
                "text"
            )),
                a.push(b);
    };
    e.prototype.setStatus = function(a, b) {
        this.$control.get(0).checked = a.data.selected || !1;
    };
    e.prototype.setByDeepLink = function(a) {
        this.observer.trigger(this.observer.events.statusChanged, [
            d(this, !1)
        ]);
    };
    jQuery.fn.jplist.ui.controls.RadioButtonsFilter = function(a) {
        return new e(a);
    };
    jQuery.fn.jplist.controlTypes["radio-buttons-filters"] = {
        className: "RadioButtonsFilter",
        options: {}
    };
})();
(function() {
    var d = function(a, b) {
            var c,
                d = null;
            c = b
                ? "true" === a.$control.attr("data-selected")
                : a.params.selected;
            a.params.path &&
                ((c = c
                    ? {
                          path: a.params.path,
                          type: "number",
                          filterType: "range",
                          min: 0,
                          max: 0,
                          prev: a.params.prev,
                          next: a.params.next,
                          selected: c
                      }
                    : { path: a.params.path, filterType: "", selected: c }),
                (d = new jQuery.fn.jplist.app.dto.StatusDTO(
                    a.name,
                    a.action,
                    a.type,
                    c,
                    a.inStorage,
                    a.inAnimation,
                    a.isAnimateToTop,
                    a.inDeepLinking
                )));
            return d;
        },
        f = function(a) {
            a.$control.on("click", function() {
                a.params.selected = !a.params.selected;
                a.history.addStatus(d(a, !1));
                a.observer.trigger(a.observer.events.unknownStatusesChanged, [
                    !1
                ]);
            });
        },
        e = function(a) {
            a.params = {
                path: a.$control.attr("data-path"),
                prev: Number(a.$control.attr("data-min")),
                next: Number(a.$control.attr("data-max")),
                selected: "true" === a.$control.attr("data-selected")
            };
            f(a);
            return jQuery.extend(this, a);
        };
    e.prototype.getStatus = function(a) {
        return d(this, a);
    };
    e.prototype.getDeepLink = function() {
        var a = "",
            b;
        this.inDeepLinking &&
            ((b = d(this, !1)),
            b.data &&
                b.data.selected &&
                (a = this.name + this.options.delimiter0 + "selected=true"));
        return a;
    };
    e.prototype.getStatusByDeepLink = function(a, b) {
        var c = null;
        this.inDeepLinking &&
            ((c = d(this, !1)),
            c.data &&
                "selected" === a &&
                "true" === b &&
                (c.data = {
                    path: this.params.path,
                    type: "number",
                    filterType: "range",
                    min: 0,
                    max: 0,
                    prev: this.params.prev,
                    next: this.params.next,
                    selected: !0
                }));
        return c;
    };
    e.prototype.getPaths = function(a) {
        var b;
        this.params.path &&
            ((b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                this.params.path,
                "number"
            )),
            a.push(b));
    };
    e.prototype.setStatus = function(a, b) {
        this.inStorage && b && this.$control.data("storage-status", a);
        (this.params.selected = a.data.selected)
            ? this.$control.addClass("jplist-selected")
            : this.$control.removeClass("jplist-selected");
    };
    jQuery.fn.jplist.ui.controls.RangeSliderToggleFilter = function(a) {
        return new e(a);
    };
    jQuery.fn.jplist.controlTypes["range-filter"] = {
        className: "RangeSliderToggleFilter",
        options: {}
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.6 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    jQuery.fn.jplist.ui.controls.TextboxDTO = function(d, f, b, a) {
        return {
            path: d,
            ignore: b,
            value: f,
            mode: a,
            filterType: "TextFilter"
        };
    };
})();
(function() {
    var d = function(a, c) {
            var e, b;
            e = a.$control.attr("data-path");
            b = c ? a.$control.attr("value") || "" : a.$control.val();
            e = new jQuery.fn.jplist.ui.controls.TextboxDTO(
                e,
                b,
                a.params.ignore,
                a.params.mode
            );
            return new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                e,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            );
        },
        f = function(a) {
            if (a.params.$button && 0 < a.params.$button.length)
                a.params.$button.on("click", function(c) {
                    c.preventDefault();
                    a.history.addStatus(d(a, !1));
                    a.observer.trigger(
                        a.observer.events.unknownStatusesChanged,
                        [!1]
                    );
                    return !1;
                });
            else
                a.$control.on(a.params.eventName, function() {
                    a.history.addStatus(d(a, !1));
                    a.observer.trigger(
                        a.observer.events.unknownStatusesChanged,
                        [!1]
                    );
                });
        },
        b = function(a) {
            a.params = {
                path: a.$control.attr("data-path"),
                dataButton: a.$control.attr("data-button"),
                mode: a.$control.attr("data-mode") || "contains",
                ignore:
                    a.$control.attr("data-ignore") ||
                    "[~!@#$%^&*()+=`'\"/\\_]+",
                eventName: a.$control.attr("data-event-name") || "keyup",
                $button: null
            };
            a.$control.val(a.$control.attr("value") || "");
            a.params.dataButton &&
                (a.params.$button = jQuery(a.params.dataButton));
            f(a);
            return jQuery.extend(this, a);
        };
    b.prototype.getStatus = function(a) {
        return d(this, a);
    };
    b.prototype.getDeepLink = function() {
        var a = "",
            c;
        this.inDeepLinking &&
            ((c = d(this, !1)),
            c.data &&
                "" !== jQuery.trim(c.data.value) &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "value=" +
                    c.data.value));
        return a;
    };
    b.prototype.getStatusByDeepLink = function(a, c) {
        var b = null;
        this.inDeepLinking &&
            ((b = d(this, !0)), b.data && "value" === a && (b.data.value = c));
        return b;
    };
    b.prototype.getPaths = function(a) {
        var b;
        b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
            this.params.path,
            null
        );
        a.push(b);
    };
    b.prototype.setStatus = function(a, b) {
        a.data &&
            (a.data.value || (a.data.value = ""),
            this.$control.val(a.data.value));
    };
    jQuery.fn.jplist.ui.controls.Textbox = function(a) {
        return new b(a);
    };
    jQuery.fn.jplist.controlTypes.textbox = {
        className: "Textbox",
        options: {}
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.4 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var d = function(a) {
            !a.history.statusesQueue || 0 >= a.history.statusesQueue.length
                ? a.$control.addClass("jplist-disabled")
                : a.$control.removeClass("jplist-disabled");
        },
        e = function(a) {
            a.observer.on(a.observer.events.unknownStatusesChanged, function() {
                d(a);
            });
            a.observer.on(a.observer.events.knownStatusesChanged, function() {
                d(a);
            });
            a.$control.on("click", function() {
                var b, c, f;
                a.history.popStatus();
                a.history.popList();
                b = a.history.getLastStatus();
                if (((f = a.history.getLastList() || []), b)) {
                    for (var g = 0; g < f.length; g++)
                        if (
                            ((c = f[g]),
                            c.name === b.name && c.action === b.action)
                        ) {
                            if (c.data)
                                for (var e in c.data)
                                    jQuery.isArray(c.data[e]) &&
                                        (c.data[e] = []);
                            jQuery.extend(!0, c, b);
                            f[g] = c;
                        }
                    a.observer.trigger(a.observer.events.knownStatusesChanged, [
                        f
                    ]);
                } else a.observer.trigger(a.observer.events.unknownStatusesChanged, [!0]);
                d(a);
            });
        },
        b = function(a) {
            d(a);
            e(a);
            return jQuery.extend(this, a);
        };
    jQuery.fn.jplist.ui.controls.BackButton = function(a) {
        return new b(a);
    };
    jQuery.fn.jplist.controlTypes["back-button"] = {
        className: "BackButton",
        options: {}
    };
})();
(function() {
    var d = function(b) {
            b.$control.on("click", function() {
                b.observer.trigger(b.observer.events.unknownStatusesChanged, [
                    !0
                ]);
            });
        },
        e = function(b) {
            d(b);
            return jQuery.extend(this, b);
        };
    jQuery.fn.jplist.ui.controls.Reset = function(b) {
        return new e(b);
    };
    jQuery.fn.jplist.controlTypes.reset = { className: "Reset", options: {} };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.2 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var g = function(a, d) {
            var b,
                c = [];
            b = null;
            var e;
            a.params.$checkboxes.each(function(a, b) {
                var f = jQuery(b);
                e = d
                    ? void 0 !== f.attr("checked")
                        ? Boolean(f.attr("checked"))
                        : !1
                    : f.get(0).checked;
                f = f.attr("data-path");
                e && f && c.push(f);
            });
            b = new jQuery.fn.jplist.ui.controls.CheckboxDropdownFilter(c);
            return (b = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                b,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        m = function(a, d) {
            a.params.$checkboxes.each(function(a, c) {
                var e;
                if ((e = jQuery(this).attr("data-path")))
                    (e = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        e,
                        "text"
                    )),
                        d.push(e);
            });
        },
        k = function(a) {
            a.params.$checkboxes.each(function(a, b) {
                var c;
                c = jQuery(b);
                c.removeClass("jplist-selected");
                c.get(0).checked = !1;
            });
        },
        l = function(a) {
            var d = a.params.$checkboxes.filter(":checked"),
                b = "",
                c;
            switch (d.length) {
                case 0:
                    b = a.params.noSelectedText;
                    break;
                case 1:
                    b = a.params.oneItemText;
                    break;
                default:
                    b = a.params.manyItemsText;
            }
            c = "";
            d.each(function(a, b) {
                0 < a && (c += ", ");
                c += jQuery.trim(
                    jQuery(b)
                        .next("label")
                        .text()
                );
            });
            b = b.replace(/{selected}/g, c);
            return (b = b.replace(/{num}/g, d.length));
        },
        n = function(a) {
            a.$control
                .find("li")
                .off()
                .on("click", function(a) {
                    a.stopPropagation();
                });
            a.params.$checkboxes.on("change", function() {
                var d = g(a, !1);
                a.observer.trigger(a.observer.events.statusChanged, [d]);
            });
        },
        h = function(a) {
            a.params = {
                $checkboxes: a.$control.find("[data-path]"),
                $panel: null,
                noSelectedText: a.$control.attr("data-no-selected-text") || "",
                oneItemText: a.$control.attr("data-one-item-text") || "",
                manyItemsText: a.$control.attr("data-many-items-text") || ""
            };
            k(a);
            new jQuery.fn.jplist.ui.panel.DropdownControl(
                a.options,
                a.observer,
                a.history,
                a.$control
            );
            a.params.$panel = a.$control.find(".jplist-dd-panel");
            n(a);
            a.params.$panel.text(l(a));
            return jQuery.extend(this, a);
        };
    h.prototype.getStatus = function(a) {
        return g(this, a);
    };
    h.prototype.getDeepLink = function() {
        var a = "",
            d,
            b = "";
        if (
            this.inDeepLinking &&
            ((d = g(this, !1)),
            d.data &&
                jQuery.isArray(d.data.pathGroup) &&
                0 < d.data.pathGroup.length)
        ) {
            for (a = 0; a < d.data.pathGroup.length; a++)
                "" !== b && (b += this.options.delimiter2),
                    (b += d.data.pathGroup[a]);
            a = this.name + this.options.delimiter0 + "pathGroup=" + b;
        }
        return a;
    };
    h.prototype.getStatusByDeepLink = function(a, d) {
        var b = null,
            c;
        this.inDeepLinking &&
            ((b = g(this, !0)),
            b.data &&
                "pathGroup" === a &&
                ((c = d.split(this.options.delimiter2)),
                0 < c.length && (b.data.pathGroup = c)));
        return b;
    };
    h.prototype.getPaths = function(a) {
        m(this, a);
    };
    h.prototype.setStatus = function(a, d) {
        var b;
        k(this);
        if (
            a.data &&
            a.data.pathGroup &&
            jQuery.isArray(a.data.pathGroup) &&
            0 < a.data.pathGroup.length
        )
            for (var c = 0; c < a.data.pathGroup.length; c++)
                (b = a.data.pathGroup[c]),
                    (b = this.params.$checkboxes.filter(
                        '[data-path="' + b + '"]'
                    )),
                    0 < b.length &&
                        (b.addClass("jplist-selected"),
                        (b.get(0).checked = !0));
        this.params.$panel.text(l(this));
    };
    jQuery.fn.jplist.ui.controls.CheckboxDropdown = function(a) {
        return new h(a);
    };
    jQuery.fn.jplist.controlTypes["checkbox-dropdown"] = {
        className: "CheckboxDropdown",
        options: {},
        dropdown: !0
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.CheckboxDropdownFilter = function(g) {
        return { pathGroup: g, filterType: "pathGroup" };
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.3 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var e = function(a, b) {
            var c,
                d,
                e,
                g,
                f = null,
                h = "";
            d = a.$control.data("path");
            g = a.$control.data("dataType");
            e = a.$control.data("dataText");
            c = a.$control.data("$countValue");
            switch (g) {
                case "path":
                    f = jQuery.fn.jplist.domain.dom.services.FiltersService.pathFilter(
                        d,
                        b
                    );
                    break;
                case "text":
                    a.controlOptions &&
                        a.controlOptions.ignore &&
                        (h = a.controlOptions.ignore);
                    f = jQuery.fn.jplist.domain.dom.services.FiltersService.textFilter(
                        e,
                        d,
                        b,
                        h
                    );
                    break;
                case "range":
                    f = jQuery.fn.jplist.domain.dom.services.FiltersService.rangeFilter(
                        d,
                        b,
                        0,
                        0,
                        Number(a.$control.data("dataMin")),
                        Number(a.$control.data("dataMax"))
                    );
            }
            f &&
                (c.html(f.length),
                0 === f.length
                    ? a.$control.addClass("count-0")
                    : a.$control.removeClass("count-0"));
        },
        l = function(a) {
            switch (a.$control.data("dataMode")) {
                case "static":
                    a.observer.on(
                        a.observer.events.collectionReadyEvent,
                        function(b, c) {
                            e(a, c.dataitems);
                        }
                    );
                    break;
                case "filter":
                    a.observer.on(a.observer.events.listFiltered, function(
                        b,
                        c,
                        d
                    ) {
                        e(a, d.dataview);
                    });
                    break;
                case "all":
                    a.observer.on(a.observer.events.setStatusesEvent, function(
                        b,
                        c,
                        d
                    ) {
                        e(a, d.dataview);
                    });
            }
            a.observer.on(a.observer.events.dataItemAdded, function(b, c, d) {
                e(a, d);
            });
            a.observer.on(a.observer.events.dataItemRemoved, function(b, c, d) {
                e(a, d);
            });
        },
        k = function(a) {
            var b, c, d, e, g, f, h;
            b = a.$control.attr("data-format");
            e = a.$control.attr("data-mode") || "static";
            g = a.$control.attr("data-type") || "path";
            c = a.$control.attr("data-path");
            d = a.$control.attr("data-text");
            f = Number(a.$control.attr("data-min"));
            h = Number(a.$control.attr("data-max"));
            b &&
                ((b = b.replace(
                    "{count}",
                    '<span data-type="count-value"></span>'
                )),
                a.$control.html(b),
                (b = a.$control.find('[data-type="count-value"]')),
                a.$control.data("$countValue", b));
            c &&
                ((b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                    c,
                    null
                )),
                a.$control.data("path", b));
            a.$control.data("dataMode", e);
            a.$control.data("dataType", g);
            a.$control.data("dataPath", c);
            a.$control.data("dataText", d);
            a.$control.data("dataMin", f);
            a.$control.data("dataMax", h);
            l(a);
            return jQuery.extend(this, a);
        };
    k.prototype.getPaths = function(a) {
        var b, c;
        b = this.$control.attr("data-path");
        c = this.$control.attr("data-type");
        b &&
            ((b = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                b,
                c
            )),
            a.push(b));
    };
    jQuery.fn.jplist.ui.controls.Counter = function(a) {
        return new k(a);
    };
    jQuery.fn.jplist.controlTypes.counter = {
        className: "Counter",
        options: { ignore: "[~!@#$%^&*()+=`'\"/\\_]+" }
    };
})();
/**
 * jPList - jQuery Data Grid Controls 0.0.7 - http://jplist.com
 * Copyright 2015 jPList Software
 */
(function() {
    var f = function(e) {
        return jQuery.extend(this, e);
    };
    f.prototype.getStatus = function(e) {
        e = new jQuery.fn.jplist.ui.controls.DefaultSortDTO(
            this.$control.attr("data-path"),
            this.$control.attr("data-type"),
            this.$control.attr("data-order"),
            this.$control.attr("data-datetime-format"),
            this.$control.attr("data-ignore")
        );
        return new jQuery.fn.jplist.app.dto.StatusDTO(
            this.name,
            this.action,
            this.type,
            e,
            this.inStorage,
            this.inAnimation,
            this.isAnimateToTop,
            this.inDeepLinking
        );
    };
    f.prototype.getPaths = function(e) {
        var f, h;
        f = this.$control.attr("data-path");
        h = this.$control.attr("data-type");
        f &&
            ((f = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                f,
                h
            )),
            e.push(f));
    };
    jQuery.fn.jplist.ui.controls.DefaultSort = function(e) {
        return new f(e);
    };
    jQuery.fn.jplist.controlTypes["default-sort"] = {
        className: "DefaultSort",
        options: {}
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.DefaultSortDTO = function(f, e, k, h, g) {
        return { path: f, type: e, order: k, dateTimeFormat: h, ignore: g };
    };
})();
(function() {
    var f = function(a) {
            var c = [];
            jQuery.each(a.get(0).attributes, function(a, d) {
                -1 !== d.name.indexOf("data-path-") && c.push(d.value);
            });
            return c;
        },
        e = function(a, c) {
            var b;
            b = null;
            var d = "",
                e = "";
            c
                ? ((b = a.$control.find('option[data-default="true"]').eq(0)),
                  0 >= b.length && (b = a.$control.find("option").eq(0)))
                : (b = a.$control.find("option:selected"));
            d = a.$control.attr("data-datetime-format") || "";
            e = a.$control.attr("data-ignore") || "";
            d = new jQuery.fn.jplist.ui.controls.DropdownSortDTO(
                b.attr("data-path"),
                b.attr("data-type"),
                b.attr("data-order"),
                d,
                e
            );
            return (b = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                d,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking,
                f(b)
            ));
        },
        k = function(a, c) {
            var b, d, e;
            a.$control.find("option").each(function() {
                b = jQuery(this).attr("data-path");
                d = jQuery(this).attr("data-type");
                b &&
                    ((e = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        b,
                        d
                    )),
                    c.push(e));
            });
        },
        h = function(a) {
            a.$control.on("change", function() {
                var c, b, d;
                c = e(a, !1);
                b = jQuery(this).find("option:selected");
                if ((d = b.attr("data-path")))
                    (c.data.path = d),
                        (c.data.type = b.attr("data-type")),
                        (c.data.order = b.attr("data-order")),
                        (c.data.additionalPaths = f(b));
                a.observer.trigger(a.observer.events.statusChanged, [c]);
            });
        },
        g = function(a) {
            h(a);
            return jQuery.extend(this, a);
        };
    g.prototype.getStatus = function(a) {
        return e(this, a);
    };
    g.prototype.getDeepLink = function() {
        var a = "",
            c;
        this.inDeepLinking &&
            ((c = e(this, !1)),
            c.data &&
                c.data.path &&
                c.data.type &&
                c.data.order &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "path" +
                    this.options.delimiter2 +
                    "type" +
                    this.options.delimiter2 +
                    "order=" +
                    c.data.path +
                    this.options.delimiter2 +
                    c.data.type +
                    this.options.delimiter2 +
                    c.data.order));
        return a;
    };
    g.prototype.getStatusByDeepLink = function(a, c) {
        var b = null,
            d;
        this.inDeepLinking &&
            ((b = e(this, !0)),
            b.data &&
                a ===
                    "path" +
                        this.options.delimiter2 +
                        "type" +
                        this.options.delimiter2 +
                        "order" &&
                ((d = c.split(this.options.delimiter2)),
                3 === d.length &&
                    ((b.data.path = d[0]),
                    (b.data.type = d[1]),
                    (b.data.order = d[2]))));
        return b;
    };
    g.prototype.getPaths = function(a) {
        k(this, a);
    };
    g.prototype.setStatus = function(a, c) {
        var b;
        b =
            "default" == a.data.path
                ? this.$control.find('option[data-path="' + a.data.path + '"]')
                : this.$control.find(
                      'option[data-path="' +
                          a.data.path +
                          '"][data-type="' +
                          a.data.type +
                          '"][data-order="' +
                          a.data.order +
                          '"]'
                  );
        0 < b.length && (b.get(0).selected = !0);
    };
    jQuery.fn.jplist.ui.controls.SortSelect = function(a) {
        return new g(a);
    };
    jQuery.fn.jplist.controlTypes["sort-select"] = {
        className: "SortSelect",
        options: {}
    };
})();
(function() {
    var f = function(a) {
            var c = [];
            jQuery.each(a.get(0).attributes, function(a, d) {
                -1 !== d.name.indexOf("data-path-") && c.push(d.value);
            });
            return c;
        },
        e = function(a, c) {
            var b = null,
                d,
                e;
            c
                ? ((b = a.$control
                      .find('li:has(span[data-default="true"])')
                      .eq(0)),
                  0 >= b.length && (b = a.$control.find("li:eq(0)")))
                : (b = a.$control.find(".active"));
            b = b.find("span");
            d = a.$control.attr("data-datetime-format") || "";
            e = a.$control.attr("data-ignore") || "";
            b = new jQuery.fn.jplist.ui.controls.DropdownSortDTO(
                b.attr("data-path"),
                b.attr("data-type"),
                b.attr("data-order"),
                d,
                e,
                f(b)
            );
            return (b = new jQuery.fn.jplist.app.dto.StatusDTO(
                a.name,
                a.action,
                a.type,
                b,
                a.inStorage,
                a.inAnimation,
                a.isAnimateToTop,
                a.inDeepLinking
            ));
        },
        k = function(a, c) {
            a.$control.find("span").each(function() {
                var a, d;
                a = jQuery(this).attr("data-path");
                d = jQuery(this).attr("data-type");
                a &&
                    "" !== jQuery.trim(a) &&
                    ((a = new jQuery.fn.jplist.domain.dom.models.DataItemMemberPathModel(
                        a,
                        d
                    )),
                    c.push(a));
            });
        },
        h = function(a) {
            a.$control
                .find("li")
                .off("click")
                .on("click", function() {
                    var c, b, d;
                    c = e(a, !1);
                    d = jQuery(this).find("span");
                    if ((b = d.attr("data-path")))
                        (c.data.path = b),
                            (c.data.type = d.attr("data-type")),
                            (c.data.order = d.attr("data-order")),
                            (c.data.additionalPaths = f(d));
                    a.observer.trigger(a.observer.events.statusChanged, [c]);
                });
        },
        g = function(a) {
            new jQuery.fn.jplist.ui.panel.DropdownControl(
                a.options,
                a.observer,
                a.history,
                a.$control
            );
            h(a);
            return jQuery.extend(this, a);
        };
    g.prototype.getStatus = function(a) {
        return e(this, a);
    };
    g.prototype.getDeepLink = function() {
        var a = "",
            c;
        this.inDeepLinking &&
            ((c = e(this, !1)),
            c.data &&
                c.data.path &&
                c.data.type &&
                c.data.order &&
                (a =
                    this.name +
                    this.options.delimiter0 +
                    "path" +
                    this.options.delimiter2 +
                    "type" +
                    this.options.delimiter2 +
                    "order=" +
                    c.data.path +
                    this.options.delimiter2 +
                    c.data.type +
                    this.options.delimiter2 +
                    c.data.order));
        return a;
    };
    g.prototype.getStatusByDeepLink = function(a, c) {
        var b;
        a: {
            b = null;
            var d;
            if (this.inDeepLinking) {
                if (
                    "number" !== a &&
                    a !==
                        "path" +
                            this.options.delimiter2 +
                            "type" +
                            this.options.delimiter2 +
                            "order" &&
                    "path" !== a
                ) {
                    b = null;
                    break a;
                }
                b = e(this, !0);
                b.data &&
                    a ===
                        "path" +
                            this.options.delimiter2 +
                            "type" +
                            this.options.delimiter2 +
                            "order" &&
                    ((d = c.split(this.options.delimiter2)),
                    3 === d.length &&
                        ((b.data.path = d[0]),
                        (b.data.type = d[1]),
                        (b.data.order = d[2])));
            }
        }
        return b;
    };
    g.prototype.getPaths = function(a) {
        k(this, a);
    };
    g.prototype.setStatus = function(a, c) {
        var b, d;
        d = this.$control.find("li");
        d.removeClass("active");
        b =
            "default" == a.data.path
                ? this.$control.find('li:has([data-path="default"])')
                : this.$control.find(
                      'li:has([data-path="' +
                          a.data.path +
                          '"][data-type="' +
                          a.data.type +
                          '"][data-order="' +
                          a.data.order +
                          '"])'
                  );
        0 >= b.length && (b = d.eq(0));
        b.addClass("active");
        this.$control.find(".jplist-dd-panel").text(b.eq(0).text());
    };
    jQuery.fn.jplist.ui.controls.SortDropdown = function(a) {
        return new g(a);
    };
    jQuery.fn.jplist.controlTypes["sort-drop-down"] = {
        className: "SortDropdown",
        options: {},
        dropdown: !0
    };
})();
(function() {
    jQuery.fn.jplist.ui.controls.DropdownSortDTO = function(f, e, k, h, g, a) {
        return {
            path: f,
            type: e,
            order: k,
            dateTimeFormat: h,
            ignore: g,
            additionalPaths: a
        };
    };
})();
!(function(t) {
    t.fn.unveil = function(i, e) {
        function n() {
            var i = a.filter(function() {
                var i = t(this);
                if (!i.is(":hidden")) {
                    var e = o.scrollTop(),
                        n = e + o.height(),
                        r = i.offset().top,
                        s = r + i.height();
                    return s >= e - u && n + u >= r;
                }
            });
            (r = i.trigger("unveil")), (a = a.not(r));
        }
        var r,
            o = t(window),
            u = i || 0,
            s = window.devicePixelRatio > 1,
            l = s ? "data-src-retina" : "data-src",
            a = this;
        return (
            this.one("unveil", function() {
                var t = this.getAttribute(l);
                (t = t || this.getAttribute("data-src")),
                    t &&
                        (this.setAttribute("src", t),
                        "function" == typeof e && e.call(this));
            }),
            o.on("scroll.unveil resize.unveil lookup.unveil", n),
            n(),
            this
        );
    };
})(window.jQuery || window.Zepto);
$(function() {
    $(document).tooltip();
});

$("document").ready(function() {
    $("#more-options").hide();

    $("#toggle-more-options").click(function() {
        $("#more-options").slideToggle();
    });

    $("img").unveil(100);

    jQuery.fn.jplist.settings = {
        rangeSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 0,
                max: 1200,
                step: 10,
                range: true,
                values: [0, 1200],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " km");
                }
            });
        },

        rangeValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " km");
        },

        phevrangeSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 0,
                max: 100,
                step: 10,
                range: true,
                values: [0, 100],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " km");
                }
            });
        },

        phevrangeValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " km");
        },

        totalrangeSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 75,
                max: 1200,
                step: 25,
                range: true,
                values: [75, 1200],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " km");
                }
            });
        },

        totalrangeValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " km");
        },

        leaseSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 200,
                max: 2750,
                step: 50,
                range: true,
                values: [200, 2750],
                slide: function(event, ui) {
                    $prev.text(" €" + ui.values[0]);
                    $next.text(" €" + ui.values[1]);
                }
            });
        },

        leaseValues: function($slider, $prev, $next) {
            $prev.text(" €" + $slider.slider("values", 0));
            $next.text(" €" + $slider.slider("values", 1));
        },

        bijtellingSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 25,
                max: 1400,
                step: 25,
                range: true,
                values: [25, 1400],
                slide: function(event, ui) {
                    $prev.text(" €" + ui.values[0]);
                    $next.text(" €" + ui.values[1]);
                }
            });
        },

        bijtellingValues: function($slider, $prev, $next) {
            $prev.text(" €" + $slider.slider("values", 0));
            $next.text(" €" + $slider.slider("values", 1));
        },

        batterySlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 10,
                max: 200,
                step: 10,
                range: true,
                values: [10, 200],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " kWh");
                }
            });
        },

        batteryValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " kWh");
        },

        effSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 100,
                max: 300,
                step: 10,
                range: true,
                values: [100, 300],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " Wh/km");
                }
            });
        },

        effValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " Wh/km");
        },

        accelerationSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 2,
                max: 23,
                range: true,
                values: [2, 23],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " s");
                }
            });
        },

        accelerationValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " s");
        },

        fastchargeSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 0,
                max: 1500,
                range: true,
                step: 50,
                values: [0, 1500],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " km/h");
                }
            });
        },

        fastchargeValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " km/h");
        },

        topspeedSlider: function($slider, $prev, $next) {
            $slider.slider({
                min: 110,
                max: 450,
                range: true,
                step: 10,
                values: [110, 450],
                slide: function(event, ui) {
                    $prev.text(ui.values[0]);
                    $next.text(ui.values[1] + " km/h");
                }
            });
        },

        topspeedValues: function($slider, $prev, $next) {
            $prev.text($slider.slider("values", 0));
            $next.text($slider.slider("values", 1) + " km/h");
        }
    };

    $("#evdb").jplist({
        animateToTop: "div.list",
        itemsBox: ".list",
        itemPath: ".list-item",
        panelPath: ".jplist-panel",
        deepLinking: true,
        redrawCallback: function() {
            $(window).trigger("lookup");
        }
    });
});
jQuery(function($) {
    $(".menu-btn").click(function() {
        $(".responsive-menu").toggleClass("expand");
    });
});

$(function() {
    $("#select_units").on("change", function() {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });
});
