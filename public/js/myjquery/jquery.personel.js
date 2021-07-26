var Personel = {
    init: function( config ) {
        this.config = config;

        try {
            this.setupTemplate();
            this.showPersonel();
        } catch ( err ) {};
    },

    setupTemplate: function() {
        this.config.detailPersonel = Handlebars.compile( this.config.detailPersonel );
    },

    showPersonel: function() {
        var self = Personel;
        
        self.config.contentDetailPersonel.append( self.config.detailPersonel() );
        
        return false;
    }
}

Personel.init({
    detailPersonel        : $('#detail-personel').html(),
    contentDetailPersonel : $('#content-detail-personel')
});