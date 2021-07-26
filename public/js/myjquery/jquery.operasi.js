var counter = $('#form-req-personel').size();

var Operasi = {
    init: function( config ) {
        this.config = config;

        try {
            this.events();
            this.setupTemplate();
            this.setJumlahOperasi();
        } catch ( err ) {};
    },

    events: function() {
        this.config.btnAddFormPersonel.on( 'click', this.setFormReqPersonel );
        this.config.btnAddFormFotoOps.on( 'click', this.setFormFotoOps );
    },

    setupTemplate: function() {
        this.config.formReqPersonel = Handlebars.compile( this.config.formReqPersonel );
        this.config.formFotoOps     = Handlebars.compile( this.config.formFotoOps );
    },

    setJumlahOperasi: function() {
        var self    = Operasi;
        var inp     = self.config.txtJumlah;
        
        if ('onpropertychange' in inp)
          inp.attachEvent($.proxy(function() {
              if (event.propertyName == 'value')
                self.config.viewJumlah.text(this.value);
          }, inp));
        else
          inp.addEventListener('input', function() { 
              self.config.viewJumlah.text(this.value);
          }, false);

        return false;
    },

    setFormReqPersonel: function() {
        var self = Operasi;
        
        self.config.contentFormReqPersonel.append( self.config.formReqPersonel({ nomor : counter }));

        counter++;

        return false;
    },

    setFormFotoOps: function() {
        var self = Operasi;
        
        self.config.contentFormFotoOps.append( self.config.formFotoOps({ nomor : counter }));

        counter++;

        return false;
    },

    hapusFormReqPersonel: function( x ) {
        var self = Operasi;

        $("#row-form-req-personel-" + x).remove();

        return false;
    },

    hapusFormFotoOps: function( y ) {
        var self = Operasi;

        $("#row-form-foto-ops-" + y).remove();

        return false;
    },

    showSelect: function( x ) {
        var self        = Operasi;
        var slcWil      = document.getElementById('slc-req-penerima-' + x);
        var slcSatker   = document.getElementById('slc-req-satker-' + x);
        var valSlcWil   = slcWil.options[slcWil.selectedIndex].text;

        if (valSlcWil == 'POLRES JOMBANG') {
            slcSatker.options[1].disabled = true;
            $("#slc-req-satker-" + x).val('reskrim');
            $('#div-slc-req-satker-' + x).show();
            $('#div-slc-req-penerima-' + x ).removeClass( "col-sm-8" ).addClass( "col-sm-5" );
        } else {
            slcSatker.options[1].disabled = false;
            $("#slc-req-satker-" + x).val('semua');
            $('#div-slc-req-satker-' + x).hide();
            $('#div-slc-req-penerima-' + x ).removeClass( "col-sm-5" ).addClass( "col-sm-8" );
        };

        return false;
    }
}

Operasi.init({
    txtJumlah               : $('#txt-jumlah-personel')[0],
    viewJumlah              : $('#view-jumlah-personel'),
    slcReqWilayah           : $('#slc-req-penerima'),
    btnAddFormPersonel      : $('#btn-add-form-req-personel'),
    formReqPersonel         : $('#form-req-personel').html(),
    contentFormReqPersonel  : $('#content-form-req-personel'),
    btnAddFormFotoOps       : $('#btn-add-form-foto-operasi'),
    formFotoOps             : $('#form-foto-ops').html(),
    contentFormFotoOps      : $('#content-form-foto-ops')
});