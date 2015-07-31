Pisma.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'pisma-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('pisma') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('pisma_items'),
				layout: 'anchor',
				items: [{
					html: _('pisma_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'pisma-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	Pisma.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.panel.Home, MODx.Panel);
Ext.reg('pisma-panel-home', Pisma.panel.Home);
