/**
 * Add dropdown menus to nearly anything with this simple plugin, including the navbar, tabs,
 * and pills.
 *
 * @see             http://twitter.github.com/bootstrap/
 * @copyright       2011 Twitter, Inc. All rights reserved.
 * @license         http://www.apache.org/licenses/LICENSE-2.0
 *
 * @class           Dropdown
 * @requires        jQuery
 */

var toggle = "[data-toggle='dropdown']", Dropdown = function (element) {
    var $el = $(element).on("click.dropdown.data-api", this.toggle);
    $("html").on("click.dropdown.data-api", function () {
        $el.parent().removeClass("open");
    });
};

function getParent ($this) {
    var selector = $this.attr("data-target"), $parent;

    if (!selector) {
        selector = $this.attr("href");
        selector = selector && /#/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, ""); //strip for ie7
    }

    $parent = $(selector);

    if (!$parent.length) {
        ($parent = $this.parent());
    }

    return $parent;
}

function clearMenus () {
    $(toggle).each(function () {
        getParent($(this)).removeClass("open");
    });
}

Dropdown.prototype = {

    constructor: Dropdown,
    toggle: function () {
        var $this = $(this),
            $parent,
            isActive;

        if ($this.is(".disabled, :disabled")) {
            return;
        }

        $parent = getParent($this);

        isActive = $parent.hasClass("open");

        clearMenus();

        if (!isActive) {
            $parent.toggleClass("open");
        }

        $this.focus();

        // Pass true if the menu is now open, false if it's been closed
        $parent.trigger("toggle.dropdown.data-api", [!isActive]);

        return false;
    },

    keydown: function (e) {
        var $this,
            $items,
            $parent,
            isActive,
            index;

        if (!/(38|40|27)/.test(e.keyCode)) {
            return;
        }

        $this = $(this);

        e.preventDefault();
        e.stopPropagation();

        if ($this.is(".disabled, :disabled")) {
            return;
        }

        $parent = getParent($this);

        isActive = $parent.hasClass("open");

        if (!isActive || (isActive && e.keyCode === 27)) {
            return $this.click();
        }

        $items = $("[role=menu] li:not(.divider):visible a", $parent);

        if (!$items.length) {
            return;
        }

        index = $items.index($items.filter(":focus"));

        // up
        if (e.keyCode === 38 && index > 0) {
            index--;
        }
        // down
        if (e.keyCode === 40 && index < $items.length - 1) {
            index++;
        }
        if (!~index) {
            index = 0;
        }

        $items.eq(index).focus();
    }

};

/**
 * Dropdown plugin definition
 *
 * @param option
 */

$.fn.dropdown = function (option) {
    return this.each(function () {
        var $this = $(this), data = $this.data("dropdown");
        if (!data) {
            $this.data("dropdown", (data = new Dropdown(this)));
        }
        if (typeof option === "string") {
            data[option].call($this);
        }
    });
};

$.fn.dropdown.Constructor = Dropdown;

/**
 * Apply to standard dropdown elements
 */
$(document).on("click.dropdown.data-api touchstart.dropdown.data-api", clearMenus).on("click.dropdown touchstart.dropdown.data-api", ".dropdown form", function (e) {
    e.stopPropagation();
}).on("touchstart.dropdown.data-api", ".dropdown-menu", function (e) {
    e.stopPropagation();
}).on("click.dropdown.data-api touchstart.dropdown.data-api", toggle, Dropdown.prototype.toggle).on("keydown.dropdown.data-api touchstart.dropdown.data-api", toggle + ", [role=menu]", Dropdown.prototype.keydown);

window.nav = window.nav || {};

nav.login = function(){
    $(".dropdown.open").removeClass("open");
    return Login.open();
};
nav.login.init = function(){
    //$('#nav-client-bar a[href="?login"]').on("click.nav.login",nav.login);
};

nav.init = function(){
    nav.login.init();
};

$(nav.init);


// sample test data, delete when dev complete
var testStatus = {
    total: 9,
    details: []
}

window.nav = window.nav || {};
window.nav.tickets = window.nav.tickets || {};


/**
 * Gets and displays unread support tickets.
 * Simplified from common version
 */
nav.tickets.initialize = function(selector) {
    if(Core.loggedIn) {
        this.self = this;
        this.counters = $(selector);
        this.ajaxSettings = {
            timeout: 3000,
            url: Core.secureSupportUrl + 'update/json',
            ifModified: true,
            global: false,
            dataType: 'jsonp',
            jsonpCallback: 'getStatus',
            contentType: "application/json; charset=utf-8",
            crossDomain: true,
            cache: false,
            data: {
                supportToken: window.supportToken
            }
        }
        this.loadStatus();
    }
}

nav.tickets.loadStatus = function(callback) {
    if(this.counters.length) {
        var _this = this,
            response = this.getUpdates(),
            callback = callback || this.handleResponse;
        response.done(function(json, status) {
            _this.handleResponse.call(_this, json, status);
        });
    }
}

nav.tickets.handleResponse = function(json, status) {
    if ("notmodified" !== status) {

        // todo: replace with actual json.total, instead of test data
        this.updateTotal(json.total);
    }
}

nav.tickets.getUpdates = function() {
    return $.ajax(this.ajaxSettings);
}

nav.tickets.updateTotal = function(count) {
    count = (typeof count === 'number') ? count : 0;
    this.counters
        .text(count)
        [(count > 0) ? "removeClass" : "addClass"]('no-updates');
}

$(function(){
    nav.tickets.initialize(".nav-support-ticket-counter");
});
$(function(){
    // adding stopPropagation breaks GTM for ie8 only...
    if (document.addEventListener) {
        // dont allow clicks on dropdown to trigger a close on the menu.
        $('#nav-client-header .dropdown-menu, #nav-client-footer .dropdown-menu').on('click', function(e) {browserAwareStopPropagation(e)});
    }
});
/**
 * Helper functions for switching language / region.
 * Modified from Locale.js in common
 */

window.nav = window.nav || {};
window.nav.locale = {
    activeRegion: null,
    activeTarget: null,
    activeLanguage: null,

    init: function(selector) {
        this.container = $(selector);

        this.container.on('click', 'a.select-region', $.proxy(this.changeRegion, this));
        this.container.on('click', 'a.select-language', $.proxy(this.changeLanguage, this));

        this.activeRegion = this.container.find('#select-regions .active');
        this.activeLanguage = this.container.find('#select-language .active').find('li');
        this.activeLanguageGroup = this.container.find('#select-language .active');
        this.currentRegion = this.container.find('#select-regions .current');
        this.currentLanguage = this.container.find('#select-language .current').find('li.current');
        this.btn = $('.nav-lang-change');
        this.btn.addClass('disabled');
    },

    disableSelection: function() {
        this.btn.addClass('disabled');
        this.activeRegion.removeClass('active');
        this.activeLanguage.removeClass('active');
        this.activeLanguageGroup.removeClass('active');
    },

    changeRegion: function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $target = $(e.target);

        // disable all active state items
        this.disableSelection();
        // remove any href the Change button may have
        this.btn.attr('href', 'javascript:;');

        // get active region
        this.activeRegion = $target.parent();
        this.activeLanguageGroup = $target.parents('.nav-international-container').find("[data-region='" + $target.attr('data-target') + "']");
        var languages = this.activeLanguageGroup.find("li");

        // set active
        this.activeLanguageGroup.addClass('active');
        this.activeRegion.addClass('active');

        // if changed back to current region and user has not chosen a language, make current language active
        if (this.activeRegion.hasClass('current') && (languages.find('active').length === 0)) {
            this.currentLanguage.addClass('active');
        }

        // if region has only 1 language, make that language pre-selected
        if (languages.length === 1) {
            languages.addClass("active");
            this.btn.removeClass('disabled');
            this.btn.attr('href', languages.find("a").attr("href"));
        }
    },

    changeLanguage: function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $target = $(e.target);
        var href = $target.attr('href');

        // disable previous language
        this.activeLanguage.removeClass('active');
        this.currentLanguage.removeClass('active');

        // reset button
        this.btn.addClass('disabled');
        this.btn.attr('href', 'javascript:;');

        // get active language
        this.activeLanguage = $target.parent();
        this.activeLanguage.addClass('active');

        // only enable button if active class is different from current class
        if (!this.activeLanguage.hasClass('current')) {
            this.btn.attr('href', href);
            this.btn.removeClass('disabled');
        }
    }
};

nav.collapsible = nav.collapsible || {};
nav.collapsible.initialize = function() {
    var _this = this;
    $("[data-toggle='nav-collapse']").on('click', _this.toggle);
};

nav.collapsible.toggle = function(e) {
    e.preventDefault();
    var target = $(this).attr('data-target');
    $(target).toggleClass('in');
    $(target).prev().toggleClass('open');
};

$(function(){
    nav.locale.init('.nav-international-container');
    nav.collapsible.initialize();
});


var Navbar = Navbar || {};
Navbar.menu_out = false;
Navbar.close = function() {
    $('.nav-mobile-menu-wrap').removeClass('out');
    this.menu_out = false;
}


$(function(){
    var $navMobileWrap = $('.nav-mobile-menu-wrap');
    var $navMobileWrapLeft = $navMobileWrap.filter('.left');
    var $navMobileWrapRight = $navMobileWrap.filter('.right');
    var $navBlackout = $('.nav-client #nav-blackout');
    var toggleMobileNav = function toggleMobileNav(side) {
        if (side === 'right') {
            $navMobileWrapLeft.removeClass('out');
            $navMobileWrapRight.addClass('out');
        } else if (side === 'left') {
            $navMobileWrapRight.removeClass('out');
            $navMobileWrapLeft.addClass('out');
        }

        Navbar.menu_out = true;
        return Navbar.menu_out;
    }
    $('.nav-remove-icon').on('click', function(e) {
        Navbar.close();
    });
    //right side menu
    $('.nav-global-menu-icon').on('click', function(e) {
        toggleMobileNav('right');
    });
    // left side menu
    $('.nav-hamburger-menu-icon').on('click', function(e) {
        toggleMobileNav('left');
    });
    // clicking on blackout while menu is out will close the menu
    $navBlackout.on('click', function(e) {
        if (Navbar.menu_out) {
            Navbar.close();
        }
    });
});

window.nav = window.nav || {};
window.nav.modals = {
    euCookieComplianceAgreed: null,

    init: function(selector) {
        this.container = $(selector);
        this.euCookieComplianceAgreed = Cookie.read('eu-cookie-compliance-agreed');
        if (!this.euCookieComplianceAgreed) {
            this.container.removeClass('hide');
            Cookie.create('eu-cookie-compliance-agreed', 1, {expires: 365 * 24, path: '/'}); //cookie is created once user has seen the disclaimer
            this.container.on('click', '#cookie-compliance-close', $.proxy(this.closeCookieModal, this));
            this.container.on('click', '#cookie-compliance-agree', $.proxy(this.closeCookieModal, this));
        }
    },

    closeCookieModal: function() {
        $('.eu-cookie-compliance.desktop').addClass('hide');
        $('.eu-cookie-compliance.mobile').addClass('hide');
        Cookie.create('eu-cookie-compliance-agreed', 1, {expires: 365 * 24, path: '/'});
    }
};

$(function() {
    nav.modals.init('.eu-cookie-compliance');
});
/**
 * @author Kyle Copeland
 * @requires Satchel.js
 */
window.nav = window.nav || {};
window.nav.notifications = {
    /**
     * Add event listener for notification dropdown
     * Clean endpoint for notifications
     * Load Notifications
     */
    config: {},
    selectors: {},
    analytics: {
        namespace: "global-notification",
        dismiss: {
            close: "Close - X"
        },
        button: { // call to action
            click: "Click - Button"
        },
        bell: {
            open: "Open - Bell",
            close: "Close - Bell",
            auto: "Open - Automatic"
        },
        background: {
            close: "Close - Background"
        },
        event: "globalNotification",
        notification: {
            title: "",
            id: ""
        },
        sendEvent: function(placement, action) {
            // Null check to prevent processing user actions when Notifications
            // are hidden
            if(this.notification.id !== "") {
                window.dataLayer.push({
                    "analytics.eventPanel" : nav.notifications.analytics.getPanel(),
                    "analytics.eventPlacement" : nav.notifications.analytics[placement][action],
                    "event": "globalNotification"
                });
            }
        },
        getPanel: function() {
            return "id:" + this.notification.id + " || " + this.notification.title;
        }
    },
    init: function() {
        this.selectors.$icon = $(".nav-notification-icon");
        this.selectors.$dropdown = $(".nav-notification-dropdown");
        this.config.allowMultiNotifications = false;
        this.config.localStorageNotificationDismiss = "dismiss";
        var selectors = nav.notifications.selectors;
        var analytics = nav.notifications.analytics;

        this.selectors.$icon.on("click", function(e) {
            browserAwareStopPropagation(e);
            // Save Dismissal on Icon click
            if ($(this).hasClass("open")) {
                nav.notifications.set(selectors.notification.first().attr("data-notification-id"), nav.notifications.config.localStorageNotificationDismiss, true);
                nav.notifications.closeDropdown();
                analytics.sendEvent("bell","close");
            }
            else {
                nav.notifications.openDropdown();
                analytics.sendEvent("bell","open");
            }
        });
        this.selectors.$dropdown.on('click', function(e) {browserAwareStopPropagation(e)});
        $(document).on("click.nav.notifications.dropdown.close", function() {
            if (selectors.$dropdown.hasClass("open")) {
                nav.notifications.closeDropdown();
                analytics.sendEvent("background","close");
            }
        });

        // Close Dropdown on menu items click
        // :has is used to check the child elements of each
        // list item
        $("[data-toggle=dropdown]").on("click.nav.notifications.dropdown.close", function() {
            if (selectors.$dropdown.hasClass("open")) {
                nav.notifications.closeDropdown();
                analytics.sendEvent("background","close");
            }
        });
        this.configEndpoint();
        this.load();
    },
    /**
     * Helper functions for events that close/open notification dropdown
     */
    closeDropdown: function() {
        this.selectors.$icon.add(this.selectors.$dropdown).removeClass("open");
    },
    openDropdown: function() {
        clearMenus();
        Navbar.close();
        this.selectors.$icon.add(this.selectors.$dropdown).addClass("open");
    },
    /**
     * Reference "nav-js.ftl" for endpoint initialization
     * If no endpoint is given use local CMS client endpoint
     */
    configEndpoint: function() {
        nav.notifications.endpoint = nav.notifications.endpoint || "";
        if (this.endpoint === "") {
            this.endpoint =  Core.projectUrl+"/notification/list";
        }
    },

    /**
     * Load a list of notifications and append them to the three
     * dropdown menus.
     * Note: the loop appending notifications stops after the first
     * notification. Remove the "break" to append all notifications.
     */
    load: function() {
        // translate locale into CMS friendly locale Ex. en-us -> en_US
        var locale = Core.locale.split("-");
        locale = locale[0] + "_" + locale[1].toUpperCase();
        $.ajax({
            headers: {
                Accept : "application/json"
            },
            type: "GET",
            url: nav.notifications.endpoint,
            data: {"locale": locale, "community": Core.project }
        }).done( function(data) {
            var notifications = data.notificationsList || [];
            if (notifications.length > 0) {
                nav.notifications.showIcon();
                var showDropdown = false;

                if (nav.notifications.config.allowMultiNotifications) {
                    for (var i = 0; i < notifications.length;  i++) {
                        if(nav.notifications.populate(notifications[i])) {
                            showDropdown = true;
                        }
                    }
                }
                else {
                    if (nav.notifications.populate(notifications[0])) {
                        showDropdown = true;
                    }
                }
                if (showDropdown) {
                    nav.notifications.openDropdown();
                    nav.notifications.analytics.sendEvent("bell","auto");
                }
            }
            // cache notification(s)
            nav.notifications.selectors.notification = $(".nav-notification");
        });
    },
    /**
     * Show notification icon
     */
    showIcon: function() {
        this.selectors.$icon.show();
    },
    /**
     * Add notifications to parent element
     */
    populate: function(notification) {
        var _this = this;
        this.selectors.$dropdown.append(this.NavNotificationComponent(notification,_this));
        var show = !nav.notifications.get(notification.id, "dismiss");
        return show;
    },
    /**
     * Local Storage
     * ---------------------------
     * Local storage is used to save dismissals of notifications.
     * Each notification's "state" will be stored in a notification.id key.
     * We are using localstorage to avoid bloating HTTP headers.
     * ---------------------------
     * Get item from local storage using Satchel.js
     */
    get: function(id, field) {
        var key = "notification." + id;
        if (!Satchel.hasKey(key)) {
            return null;
        }
        return Satchel.get(key)[field];
    },
    /**
     * Set item in local storage using Satchel.js
     */
    set: function(id, field, value) {
        var key = "notification." + id;
        var notification = Satchel.get(key) || {};
        notification[field] = value;
        Satchel.set(key,notification);
    },
    /**
     * Notification:
     * Required: Title
     * Optional: button, img, content
     * Event Listener: Click "X" to dismiss notification and save to local storage.
     */
    NavNotificationComponent: function(notification, _this) {
        var analytics = this.analytics;
        var selectors = this.selectors;
        var nav = this;
        var $el = $("<div>", {"class":"nav-notification"}).attr("data-notification-id", notification.id);
        // Append "X"
        var $x = $("<a class='nav-notification-remove'><i class='nav-close'></i></a>");
        $el.append($x);

        // Append Header : image/title
        NavNotificationHeader($el);

        // Append Body : content/call-to-action button
        NavNotificationBody($el);

        // Add Event Listeners
        $el.find(".nav-notification-remove, .nav-notification-btn").click(function(e) {
            browserAwareStopPropagation(e)
            nav.closeDropdown();

            if ($(this).hasClass("nav-notification-remove")) {
                analytics.sendEvent("dismiss","close");
            }
            else {
                analytics.sendEvent("button","click");
            }
            nav.set($el.attr("data-notification-id"), "dismiss", true);
        });

        // Add title/id to analytics
        analytics.notification.title = notification.title;
        analytics.notification.id = notification.id;

        function NavNotificationHeader($el) {
            var $header = $("<div>",{"class":"nav-notification-header"});
            if (notification.img) {
                $header.append("<img class='nav-notification-img' src='" + notification.img.url + "'/>");
            }
            $header.append("<h1 class='nav-notification-title'>" + notification.title + "</h1>");
            $el.append($header);
        }

        function NavNotificationBody($el) {
            if (notification.content) {
                $el.append("<p class='nav-notification-content'>" + notification.content + "</p>");
            }
            if (notification.httpLink) {
                var $button = $("<a class='nav-notification-btn nav-item nav-btn nav-btn-block' href='"+notification.httpLink.link+"'>" + notification.httpLink.content + "</a>");
                $el.append($button);
            }
        }

        return $el;
    }
};

function browserAwareStopPropagation(e)
{
    if (!e)
        e = window.event;

    //IE9 & Other Browsers
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    //IE8 and Lower
    else {
        e.cancelBubble = true;
    }
}

$(function() {
    nav.notifications.init();
});
/**
 * Methods for creating, reading, and deleting cookies.
 */
var Cookie = {

    /**
     * Cached cookies.
     */
    cache: {},

    /**
     * Create a cookie. Can accept a third parameter as a literal object of options.
     *
     * @param key
     * @param value
     * @param options
     */
    create: function(key, value, options) {
        options = $.extend({}, options);
        options.expires = options.expires || 1; // Default expiration: 1 hour

        if (typeof options.expires === 'number') {
            var hours = options.expires;

            options.expires = new Date();
            options.expires.setTime(options.expires.getTime() + (hours * 3600000));
        }

        var cookie = [
            encodeURIComponent(key) + '=',
            options.escape ? encodeURIComponent(value) : value,
            options.expires ? '; expires=' + options.expires.toUTCString() : '',
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ];

        document.cookie = cookie.join('');

        if (Cookie.cache) {
            if (options.expires.getTime() < (new Date()).getTime()) {
                delete Cookie.cache[key];
            } else {
                Cookie.cache[key] = value;
            }
        }
    },

    /**
     * Read a cookie.
     *
     * @param key
     * @return string
     */
    read: function(key) {
        // Use cache when available
        if (Cookie.cache[key]) {
            return Cookie.cache[key];
        }

        var cache = {};
        var cookies = document.cookie.split(';');

        if (cookies.length > 0) {
            for (var i = 0; i < cookies.length; i++) {
                var parts = cookies[i].split('=');

                if (parts.length >= 2) {
                    cache[$.trim(parts[0])] = parts[1];
                }
            }
        }

        Cookie.cache = cache;

        return cache[key] || null;
    },

    /**
     * Delete a cookie.
     *
     * @param key
     */
    erase: function(key, options) {
        if (!options) {
            options = { expires: -1 };

        } else if (!options.expires) {
            options.expires = -1;
        }

        Cookie.create(key, 0, options);
    },

    /**
     * Returns whether cookies are supported/enabled by the browser
     *
     * @return boolean
     */
    isSupported: function() {
        return (document.cookie.indexOf('=') !== -1);
    }
};
var Satchel = {
    /**
     * Satchel.isSupported is false by default, and is changed to `true` in an IIFE
     * @type {Boolean}
     */
    isSupported: false,

    /**
     * Get `key` from localStorage (if localStorage is supported)
     * @param key {string}
     *
     * @returns {string|null} the value of `key`
     */
    get: function _get(key) {

        if (Satchel.isSupported && key) {
            var data = localStorage.getItem(key);

            try {
                return JSON.parse(data);
            } catch (e) {

                return data;
            }
        }

        return null;
    },

    /**
     * Get all of the items in localStorage. If `namespace` is provided, limit
     * items to those matching the namespace
     * @param [namespace] {string}
     *
     * @returns {object} Array of items
     */
    getAll: function _getAll(namespace) {
        var items = [];

        if (!Satchel.isSupported) {
            return items;
        }

        for (var i = 0, l = localStorage.length, _key = null; i < l; i++) {
            _key = localStorage.key(i);

            if (namespace && _key.indexOf(namespace) !== 0) {
                continue;
            }

            items.push({
                key:   _key,
                value: Satchel.get(_key)
            });
        }

        return items;
    },

    /**
     * Get all of the keys in localStorage. If `namespace` is provided, limit
     * keys to those matching the namespace
     * @param [namespace] {string}
     *
     * @returns {object} Array of keys
     */
    getKeys: function _getKeys(namespace) {
        var keys = [];

        if (!Satchel.isSupported) {
            return keys;
        }

        for (var i = 0, l = localStorage.length, _key = null; i < l; i++) {
            _key = localStorage.key(i);

            if (namespace && _key.indexOf(namespace) !== 0) {
                continue;
            }

            keys.push(_key);
        }

        return keys;
    },

    /**
     * Check to see if `key` exists in localStorage
     * @param key {string}
     *
     * @returns {boolean}
     */
    hasKey: function _hasKey(key) {

        if (Satchel.isSupported && key) {

            return (localStorage.getItem(key) && true) || false;
        }

        return false;
    },

    /**
     * Set `value` to `key` in localStorage
     * @param key {string}
     * @param value {string|number|object}
     *
     * @returns {boolean} Returns `true` if the value was successfully set,
     * else returns `false`
     */
    set: function _set(key, value) {

        if (Satchel.isSupported && key) {
            try {
                localStorage.setItem(key, JSON.stringify(value || ""));
            } catch (e) {

                return false;
            }

            return true;
        }

        return false;
    },

    /**
     * Remove the item matching `key` from localStorage
     * @param key {string}
     *
     * @returns {boolean} Returns `true` if the value was successfully removed,
     * else returns `false`
     */
    remove: function _remove(key) {

        if (Satchel.isSupported && key) {
            localStorage.removeItem(key);

            return true;
        }

        return false;
    },

    /**
     * Removes all of the data from localStorage
     *
     * @returns {boolean} Returns `true` if all of the data was successfully removed,
     * else returns `false`
     */
    clear: function _clear() {

        if (Satchel.isSupported) {
            localStorage.clear();

            return true;
        }

        return false;
    },

    /**
     * Get the number of the items in localStorage. If `namespace` is provided,
     * limit number to those matching namespace
     * @param [namespace]
     *
     * @returns {number}
     */
    size: function _size(namespace) {

        if (Satchel.isSupported && namespace) {
            return Satchel.getAll(namespace).length;
        }

        return localStorage.length || 0;
    }
};

/**
 * Sets the value of Satchel.isSupported to true if `window.localStorage` is supported
 */
(function () {
    if (window.localStorage) Satchel.isSupported = true;
})();