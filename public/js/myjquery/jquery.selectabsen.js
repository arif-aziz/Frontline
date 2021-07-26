var SelectAbsen = {
    init: function( config ) {
        this.config = config;

        try {
            this.events();
            this.showAbsen();
            this.setupTemplate();
        } catch ( err ) {};
    },

    events: function() {
        this.config.btnCekAbsen.on('click', this.showAbsen);
    },

    setupTemplate: function() {
        try {
            this.config.listAbsen = Handlebars.compile( this.config.listAbsen );
        } catch ( err ) {};
    },

    showAbsen: function() {
        var self = SelectAbsen;
        
        $.ajax({
            url: 'personel/filter',
            type: 'GET',
            data: self.config.formCekAbsen.serialize(),
            dataType: 'json',
            success: function( dataAbsen ) {
                self.config.contentListPersonel.empty().append( 
                    self.config.listAbsen({ 
                        tmpAbsensi : dataAbsen.absen
                    })
                );
            }
        });

        return false;
    }
}

SelectAbsen.init({
    listAbsen           : $('#list-personel').html(),
    contentListPersonel : $('#content-list-personel'),
    formCekAbsen        : $('#form-cek-absen'),
    txtTglAbsen         : document.getElementById('txt-tanggal-absen'),
    slcWilayah          : document.getElementById('slc-wilayah'),
    slcSatker           : document.getElementById('slc-satker'),
    btnCekAbsen         : $('#btn-cek-absen')
});