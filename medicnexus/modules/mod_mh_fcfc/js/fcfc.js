/**
 * @author     mediahof, Kiel-Germany
 * @link       http://www.mediahof.de
 * @copyright  Copyright (C) 2011 - 2013 mediahof. All rights reserved.
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @example       new fcfc(rows.length, fadeSpeed, fadeOutTime, idPrefix);
 */

function fcfc(oft, fadeSpeed, fadeOutTime, idPrefix) {
    var self = this, oftc = oft, k = 0;

    self.initialize = function () {
        fadeIn(idPrefix + oft, fadeSpeed);

        window.setInterval(function () {
            fadek(idPrefix);
        }, fadeOutTime);
    }

    function transparent(f2nid, trans) {
        document.getElementById(f2nid).style.display = 'block';
        if (window.navigator.appName == 'Microsoft Internet Explorer') {
            document.getElementById(f2nid).style.filter = 'alpha(opacity=' + trans + ')';
        } else {
            document.getElementById(f2nid).style.opacity = (trans / 100);
        }
    }

    function fadeOut(f2nid, zeit) {
        document.getElementById(f2nid).style.zIndex = 998;
        for (var count = 1; count <= 20; count++) {
            (function (trans) {
                setTimeout(function () {
                    transparent(f2nid, trans);
                }, (zeit * count));
            })(100 - (count * 5));
        }
    }

    function fadeIn(f2nid, zeit) {
        document.getElementById(f2nid).style.zIndex = 999;
        for (var count = 1; count <= 20; count++) {
            (function (trans) {
                setTimeout(function () {
                    transparent(f2nid, trans);
                }, (zeit * count));
            })((count * 5));
        }
    }

    function fadek(f2nid) {
        if (k == 1) {
            k = 0;
        } else {
            if (oft == 1) {
                fadeOut(f2nid + oft, fadeSpeed);
                oft = oftc;
                fadeIn(f2nid + oft, fadeSpeed);
                k = 1;
            } else {
                fadeOut(f2nid + oft, fadeSpeed);
                fadeIn(f2nid + (oft - 1), fadeSpeed);
                oft = oft - 1;
            }
        }
    }

    this.initialize();
}