Pisma.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'pisma-panel-home', renderTo: 'pisma-panel-home-div'
		}]
	});
	Pisma.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.page.Home, MODx.Component);
Ext.reg('pisma-page-home', Pisma.page.Home);