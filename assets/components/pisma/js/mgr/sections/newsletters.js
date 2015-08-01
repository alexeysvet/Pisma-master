Pisma.page.Newsletters = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'pisma-panel-newsletters', renderTo: 'pisma-panel-newsletters-div'
		}]
	});
	Pisma.page.Newsletters.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.page.Newsletters, MODx.Component);
Ext.reg('pisma-page-newsletters', Pisma.page.Newsletters);