(function () {
	var readyBound = false;
	var bindReady = function () {
		if (readyBound) return;
		readyBound = true;
		if (document.addEventListener) {
			document.addEventListener("DOMContentLoaded", function () {
				document.removeEventListener("DOMContentLoaded", arguments.callee, false);
				ready();
			}, false);
		} else if (document.attachEvent) {
			document.attachEvent("onreadystatechange", function () {
				if (document.readyState === "complete") {
					document.detachEvent("onreadystatechange", arguments.callee);
					ready();
				}
			});
			if (document.documentElement.doScroll && window == window.top) (function () {
				if (isReady) return;
				try {
					document.documentElement.doScroll("left");
				} catch (error) {
					setTimeout(arguments.callee, 0);
					return;
				}
				ready();
			})();
		}
		if (window.addEventListener)
			window.addEventListener('load', ready, false);
		else if (window.attachEvent)
			window.attachEvent('onload', ready);
		else
			window.onload = ready;
	}
	var isReady = false
	var readyList = [];
	var ready = function () {
		if (!isReady) {
			isReady = true;
			if (readyList) {
				var fn_temp = null
				while (fn_temp = readyList.shift()) {
					fn_temp.call(document);
				}
				readyList = null;
			}
		}
	}
	domReady = function (fn) {
		bindReady();
		if (isReady)
			fn.call(document);
		else
			readyList.push(fn);
		return this;
	}
})();

domReady(function () {
	var seo_header = document.getElementById('text-description-page'),
		seo_footer = document.getElementById('seo_footer');
	seo_footer.appendChild(seo_header);
});