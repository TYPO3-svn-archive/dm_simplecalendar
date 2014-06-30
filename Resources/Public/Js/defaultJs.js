
(function($){

        // BOOTSTRAP JS WITH LOCAL FALLBACK
        if(typeof($.fn.modal) === 'undefined') {
            console.log('JS  -> BS included..');
            document.write('<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"><\/script>')
        }

        // BOOTSTRAP CDN FALLBACK CSS
        $(document).ready(function() {

            if( verifyStyle('form-inline') )
            {
            	console.log('CSS -> BS included..');
                $("head").prepend("<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' type='text/css' media='screen'>");
            }
            else
            {
            	console.log('CSS -> BS already loaded');
            }
        });

        function verifyStyle(selector) {//http://stackoverflow.com/a/983817/579646
            var rules;
            var haveRule = false;

            if (typeof document.styleSheets != "undefined") {   //is this supported
                var cssSheets = document.styleSheets;

                outerloop:
                for (var i = 0; i < cssSheets.length; i++) {

                     //using IE or FireFox/Standards Compliant
                    rules =  (typeof cssSheets[i].cssRules != "undefined") ? cssSheets[i].cssRules : cssSheets[i].rules;

                     for (var j = 0; j < rules.length; j++) {
                         if (rules[j].selectorText == selector) {
                                 haveRule = true;
                                break outerloop;
                         }
                    }//innerloop

                }//outer loop
            }//endif

            return haveRule;
        }//eof

    })(jQuery);