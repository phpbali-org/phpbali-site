'use strict';
requirejs.config({
    paths: {
        "jquery": "core/jquery.3.2.1.min",
        "popper": "core/popper.min",
        "bootstrap": "core/bootstrap.min",
        "nowuikit": "core/now-ui-kit",
        "fastclick": "plugins/niceselect/fastclick",
        "niceselect": "plugins/niceselect/jquery.nice-select",
        "app": "app",
    },
    packages: [{
	    name: 'moment',
	    // This location is relative to baseUrl. Choose bower_components
	    // or node_modules, depending on how moment was installed.
	    location: 'plugins/moment',
	    main: 'moment'
	}],
    shim: {
    	"popper" : {
    		deps: ["jquery"]
    	},
        "bootstrap": {
            deps: ["jquery","popper"]
        },
        "nowuikit": {
        	deps: ["jquery"]
        },
        "niceselect": {
            deps: ["jquery","fastclick"]
        }
    }
});

require(["popper","jquery","niceselect"], function(p){
    require(["core/now-ui-kit"], function(nowuikit){
        nowuiKit.initContactUs2Map();
    });
    window.Popper = p;
	require(["app"]);
    // $('#select_category').niceSelect();
 //    require(["plugins/niceselect/fastclick"]);
 //    require(["plugins/niceselect/jquery.nice-select"])
});