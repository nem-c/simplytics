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

    console.log(imD);
    console.log(imQS);

    function cb() {
        u = {};
        u.p = 'http';
        u.s = '://'
        u.pf = 'www.';
        u.d = 'globalauctionguide';
        u.e = '.com';
        u.u = '/simplytics/track/';

        if (iSN()) {
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
            qs.push('slm_va=' + tV[0]);
            qs.push('slm_vid=' + '[' + tV[1].join(',') + ']');
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

