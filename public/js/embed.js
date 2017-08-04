(function() {
    var FP_ROOT = "https://floorplanner.com";
    var DEFAULT_OPTIONS = {
            'details':  true,
            'assets':   true,
            'media':    true,
            'location': true,
            'share':    true,
            'export':   true,
            'tutorial': true,
            'hidedrawing': false,
            'initial':  'assets',
            'state':    'show'
    };

    function Floorplanner(container, projectId, options) {
        if (!isElement(container)) {
            container = document.getElementById(container);
        }
        options = mergeOptions(DEFAULT_OPTIONS, options);
        this.projectId = projectId;
        this.iframe = document.createElement('iframe');
        this.iframe.src = getEmbedUrl(projectId, options);
        this.iframe.frameBorder = '0';
        this.iframe.style.width = '100%';
        this.iframe.style.height = '100%';
        this.iframe.style.borderWidth = '0';
        container.appendChild(this.iframe);

        var that = this;
        addEvent(window, 'message', function(e) {
            that.isDirtyHandler_(e);
        });
    }

    Floorplanner.prototype.destroy = function() {
        this.iframe.src = 'about:blank';
    };

    Floorplanner.prototype.isDirty = function(cb) {
        this.isDirtyCb_ = cb;
        this.callMethod_('isDirty');
    };

    Floorplanner.prototype.on = function(name, handler) {
        if (!this._handlers) {
            this._handlers = [];
        }
        var that = this;
        var fn = function(e) {
            var data;
            eval("data = " + e.data);
            if (data.type == name && data.projectId == that.projectId) {
                handler(data);
            }
        };
        addEvent(window, 'message', fn);
        this._handlers.push(fn);
    };

    Floorplanner.prototype.removeHandlers = function() {
        if (!this._handlers) {
            return;
        }
        for (var i = 0; i < this._handlers.length; i++) {
            removeEvent(window, 'message', this._handlers[i]);
        }
    };

    Floorplanner.prototype.save = function() {
        this.callMethod_('save');
    };

    Floorplanner.prototype.callMethod_ = function(method) {
        this.iframe.contentWindow.postMessage('{"method": "' + method + '"}', '*');
    };

    Floorplanner.prototype.isDirtyHandler_ = function(e) {
        if (this.isDirtyCb_) {
            var data;
            eval("data = " + e.data);
            if (data && data.method == 'isDirty') {
                this.isDirtyCb_(data.value);
                this.isDirtyCb_ = null;
            }
        }
    };

    function addEvent(obj, evType, fn, useCapture) {
        if (obj.addEventListener){
            obj.addEventListener(evType, fn, useCapture);
            return true;
        } else if (obj.attachEvent){
            var r = obj.attachEvent("on" + evType, fn);
            return r;
        }
    }

    function removeEvent(obj, evType, fn, useCapture) {
        if (obj.removeEventListener){
            obj.removeEventListener(evType, fn, useCapture);
            return true;
        } else if (obj.detachEvent){
            var r = obj.detachEvent("on"+evType, fn);
            return r;
        }
    }

    function getEmbedUrl(projectId, options) {
        var initial;
        if (options.initial) {
            initial = options.initial;
            delete options.initial;
        }
        var url = FP_ROOT
            + "/projects/"
            + projectId
            + "/embed2?"
            + getParams(options);
        if (initial) {
            url += "#" + initial;
        }
        return url;
    }

    function getParams(o) {
        var q = [];
        for (p in o) {
            q.push(p + "=" + o[p]);
        }
        return q.join("&");
    }

    function isElement(o) {
        return (
            typeof HTMLElement === 'object' ? o instanceof HTMLElement : // DOM 2
            typeof o === 'object' && o.nodeType === 1 && typeof o.nodeName === 'string'
            );
    }

    function mergeOptions(o1, o2) {
        o1 = typeof o1 === 'object' ? o1 : {};
        o2 = typeof o2 === 'object' ? o2 : {};
        var r = {};
        for (p in o1) {
            r[p] = o1[p];
        }
        for (p in o2) {
            r[p] = o2[p];
        }
        return r;
    }

    window.Floorplanner = Floorplanner; // export
})();
