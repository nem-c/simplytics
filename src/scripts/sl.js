// Create Base64 Object
var Base64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=", encode: function (e) {
        var t = "";
        var n, r, i, s, o, u, a;
        var f = 0;
        e = Base64._utf8_encode(e);
        while (f < e.length) {
            n = e.charCodeAt(f++);
            r = e.charCodeAt(f++);
            i = e.charCodeAt(f++);
            s = n >> 2;
            o = (n & 3) << 4 | r >> 4;
            u = (r & 15) << 2 | i >> 6;
            a = i & 63;
            if (isNaN(r)) {
                u = a = 64
            } else if (isNaN(i)) {
                a = 64
            }
            t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
        }
        return t
    }, decode: function (e) {
        var t = "";
        var n, r, i;
        var s, o, u, a;
        var f = 0;
        e = e.replace(/[^A-Za-z0-9+/=]/g, "");
        while (f < e.length) {
            s = this._keyStr.indexOf(e.charAt(f++));
            o = this._keyStr.indexOf(e.charAt(f++));
            u = this._keyStr.indexOf(e.charAt(f++));
            a = this._keyStr.indexOf(e.charAt(f++));
            n = s << 2 | o >> 4;
            r = (o & 15) << 4 | u >> 2;
            i = (u & 3) << 6 | a;
            t = t + String.fromCharCode(n);
            if (u != 64) {
                t = t + String.fromCharCode(r)
            }
            if (a != 64) {
                t = t + String.fromCharCode(i)
            }
        }
        t = Base64._utf8_decode(t);
        return t
    }, _utf8_encode: function (e) {
        e = e.replace(/rn/g, "n");
        var t = "";
        for (var n = 0; n < e.length; n++) {
            var r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r)
            } else if (r > 127 && r < 2048) {
                t += String.fromCharCode(r >> 6 | 192);
                t += String.fromCharCode(r & 63 | 128)
            } else {
                t += String.fromCharCode(r >> 12 | 224);
                t += String.fromCharCode(r >> 6 & 63 | 128);
                t += String.fromCharCode(r & 63 | 128)
            }
        }
        return t
    }, _utf8_decode: function (e) {
        var t = "";
        var n = 0;
        var r = c1 = c2 = 0;
        while (n < e.length) {
            r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r);
                n++
            } else if (r > 191 && r < 224) {
                c2 = e.charCodeAt(n + 1);
                t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                n += 2
            } else {
                c2 = e.charCodeAt(n + 1);
                c3 = e.charCodeAt(n + 2);
                t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                n += 3
            }
        }
        return t
    }
};


(function (i) {
    var slC = '__sltc';
    var imE = document.createElement('img');
    imE.style.display = 'none';

    if (gCV(slC) === '') {
        sCV(slC, rID());
    }

    var imD = cb();
    var imQS = bQS();

    imE.src = imD + '?' + imQS;

    function cb() {
        u = {};
        u.p = 'http';
        u.s = '://'
        u.pf = 'www.';
        u.d = 'globalauctionguide';
        u.e = '.com';
        u.u = '/simplytics/track/';

        if (iSN()) {
            u.d = 'global';
            u.e = '.dev';
        }
        if (iSD()) {
            u.pf = 'dev.';
        }
        if (iSS()) {
            u.pf = 'staging.'
        }

        return jO(u);

    }

    function iSN() {
        return (gV('__nmc') === 1);
    }

    function iSD() {
        return (gV('__dev') === 1);
    }

    function iSS() {
        return (gV('__stg') === 1);
    }

    function sCV(n, v, d) {
        if (!d) {
            d = 1;
        }
        var dt = new Date();
        dt.setTime(dt.getTime() + (d * 24 * 60 * 60 * 1000));
        var e = "; expires=" + dt.toUTCString();
        document.cookie = n + '=' + v + e + '; path=/';
    }

    function gCV(n) {
        var r = '';
        var v = "; " + document.cookie;
        var p = v.split("; " + n + "=");
        if (p.length == 2) {
            r = p.pop().split(";").shift()
        } else {
            r = ''
        }
        return r;
    }

    function gV(v) {
        for (var k in i) {
            var c = i[k];
            if (c[0] === v) {
                return c[1];
            }
        }
    }

    function jO(o) {
        var j = [];
        for (var k in o) {
            j.push(o[k]);
        }
        return j.join('');
    }

    function bQS() {
        var qs = [];
        var pr = document.createElement('a');
        pr.href = window.location.href;
        qs.push('sid=' + gV('_sid'));
        qs.push('cid=' + gCV(slC));
        qs.push('ds=' + encodeURIComponent(pr.protocol + '//' + pr.hostname));
        qs.push('us=' + encodeURIComponent(pr.pathname + pr.search));

        //trackClick event
        if (typeof gV('_trackClick') === 'object') {
            var tC = gV('_trackClick');
            qs.push('slm_ca=' + tC[0]);
            qs.push('slm_cid=' + tC[1]);
        }
        //trackView event
        if (typeof gV('_trackView') === 'object') {
            var tV = gV('_trackView');
            if (Array.isArray(tV[0])) {
                for (tVI in tV) {
                    var tVS = tV[tVI];
                    qs.push('slm_va[' + tVI + ']=' + tVS[0]);
                    qs.push('slm_vid[' + tVI + ']=' + '[' + tVS[1].join(',') + ']');
                }
            } else {
                if (Array.isArray(tV[1])) {
                    qs.push('slm_va[0]=' + tV[0]);
                    qs.push('slm_vid[0]=' + '[' + tV[1].join(',') + ']');
                }
            }
        }

        var hC = Base64.decode(window.location.hash.replace('#', ''));
        if (hC) {
            var vC = JSON.parse(hC);
            if (vC) {
                if (vC.custom) {
                    for (var c in vC.custom) {
                        var cF = vC.custom[c];
                        for (var kN in cF) {
                            var kV = cF[kN];
                            if (kN && kV) {
                                qs.push('slm_cf[' + c + ']=' + kN);
                                qs.push('slm_cfv[' + c + ']=' + kV);
                            }
                        }
                    }
                }
            }
        }

        return qs.join('&');
    }

    function rID() {
        var m = "";
        var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for (var k = 0; k < 8; k++)
            m += p.charAt(Math.floor(Math.random() * p.length));

        return m;
    }

})(_sl);