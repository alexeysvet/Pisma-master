Pisma.panel.Newsletters = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'pisma-panel-newsletters',
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
				title: _('pisma_newsletters'),
				layout: 'anchor',
				items: [{
					html: _('pisma_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'pisma-grid-newsletters',
					cls: 'main-wrapper',
				}]
			},{
				title: _('pisma_groups'),
				layout: 'anchor',
				items: [{
					html: _('pisma_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'pisma-grid-groups',
					cls: 'main-wrapper',
				}]
			},{
				title: _('pisma_subscribers'),
				layout: 'anchor',
				items: [{
					html: _('pisma_intro_msg'),
					cls: 'panel-desc',
				}]
			}]
		}]
	});
	Pisma.panel.Newsletters.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.panel.Newsletters, MODx.Panel);
Ext.reg('pisma-panel-newsletters', Pisma.panel.Newsletters);
