var SelectWilayah = {
    init: function( config ) {
        this.config = config;

        try {
          this.showSelectPersonel();
          this.showSelectAbsen();
          this.showSelectRekapAbsen();
          this.showSelectOps();
        } catch ( err ) {};
    },

    showSelectPersonel: function() {
        var self = SelectWilayah;
        var slcWil = document.getElementById('slc-wilayah');
        var valSlcWil = slcWil.options[slcWil.selectedIndex].value;
        
        if (valSlcWil == 0) {
          $('#div-slc-satker-person').show();
          $('#div-slc-wilayah-person').removeClass( 'col-sm-10' ).addClass( 'col-sm-7' );
        } else {
          $('#div-slc-satker-person').hide();
          $('#div-slc-wilayah-person').removeClass( 'col-sm-7' ).addClass( 'col-sm-10' );
        };

        return false;
    },

    showSelectAbsen: function() {
        var self = SelectWilayah;
        var slcWil = document.getElementById('slc-wilayah');
        var valSlcWil = slcWil.options[slcWil.selectedIndex].value;
        
        if (valSlcWil == 0) {
          $('#div-slc-satker-absen').show();
          $('#div-slc-wilayah-absen').removeClass( 'col-sm-7' ).addClass( 'col-sm-4' );
        } else {
          $('#div-slc-satker-absen').hide();
          $('#div-slc-wilayah-absen').removeClass( 'col-sm-4' ).addClass( 'col-sm-7' );
        };

        return false;
    },

    showSelectRekapAbsen: function() {
        var self = SelectWilayah;
        var slcWil = document.getElementById('slc-rekap-wilayah');
        var valSlcWil = slcWil.options[slcWil.selectedIndex].value;
        
        if (valSlcWil == 0) {
          $('#div-slc-satker-rekap-absen').show();
          $('#lbl-rekap-satker').show();
        } else {
          $('#div-slc-satker-rekap-absen').hide();
          $('#lbl-rekap-satker').hide();
        };

        return false;
    },

    showSelectOps: function() {
        var self = SelectWilayah;
        var slcWil = document.getElementById('slc-wilayah');
        var valSlcWil = slcWil.options[slcWil.selectedIndex].value;
        
        if (valSlcWil == 0) {
          $('#div-slc-satker-ops').show();
          $('#div-slc-wilayah-ops').removeClass( 'col-sm-7' ).addClass( 'col-sm-4' );
        } else {
          $('#div-slc-satker-ops').hide();
          $('#div-slc-wilayah-ops').removeClass( 'col-sm-4' ).addClass( 'col-sm-7' );
        };

        return false;
    }
}

SelectWilayah.init({});