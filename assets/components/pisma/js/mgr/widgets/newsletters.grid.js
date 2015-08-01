Pisma.grid.Newsletters = function (config) {
	config = config || {};
	if (!config.id) {config.id = 'pisma-grid-items';}
	Ext.applyIf(config, {
		url: Pisma.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {action: 'mgr/newsletters/getlist'},
		listeners: {},
		viewConfig: {
			forceFit: true,
			enableRowBody: true,
			autoFill: true,
			showPreview: true,
			scrollOffset: 0
		},
		paging: true,
		remoteSort: true,
		autoHeight: true
	});
	Pisma.grid.Newsletters.superclass.constructor.call(this, config);
	// Clear selection on grid refresh
	this.store.on('load', function () {if (this._getSelectedIds().length) {this.getSelectionModel().clearSelections();}}, this);
};
Ext.extend(Pisma.grid.Newsletters, MODx.grid.Grid, {
	windows: {},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();
		var row = grid.getStore().getAt(rowIndex);
		var menu = Pisma.utils.getMenu(row.data['actions'], this, ids);
		this.addContextMenuItem(menu);
	},

	createItem: function (btn, e) {
		var w = MODx.load({
			xtype: 'pisma-newsletter-window-create',
			id: Ext.id(),
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues({active: true});
		w.show(e.target);
	},

	removeItem: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.msg.confirm({
			title: ids.length > 1
				? _('pisma_newsletters_remove')
				: _('pisma_newsletter_remove'),
			text: ids.length > 1
				? _('pisma_newsletters_remove_confirm')
				: _('pisma_newsletter_remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/newsletters/remove',
				ids: Ext.util.JSON.encode(ids)
			},
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();
					}, scope: this
				}
			}
		});
		return true;
	},

	getFields: function (config) {return ['id', 'title', 'date', 'emails','emails_sent', 'attachment', 'actions'];},

	getColumns: function (config) {
		return [
			{header: _('pisma_newsletter_id'),dataIndex: 'id',sortable: true,width: 70},
			{header: _('pisma_newsletter_title'),dataIndex: 'title',sortable: true,width: 200},
			{header: _('pisma_newsletter_date'),dataIndex: 'date',sortable: false,width: 100},
			{header: _('pisma_newsletter_emails'),dataIndex: 'emails',sortable: false,width: 100},
			{header: _('pisma_newsletter_emails_sent'),dataIndex: 'emails_sent',sortable: true,width: 100},
			{header: _('pisma_newsletter_attachment'),dataIndex: 'attachment',sortable: true,width: 100}
		]
	},

	getTopBar: function (config) {
		return [{
			text: '<i class="icon icon-plus"></i>&nbsp;' + _('pisma_newsletter_create'),
			handler: this.createItem,
			scope: this
		}
		];
	},

	onClick: function (e) {
		var elem = e.getTarget();
		if (elem.nodeName == 'BUTTON') {
			var row = this.getSelectionModel().getSelected();
			if (typeof(row) != 'undefined') {
				var action = elem.getAttribute('action');
				if (action == 'showMenu') {
					var ri = this.getStore().find('id', row.id);
					return this._showMenu(this, ri, e);
				}
				else if (typeof this[action] === 'function') {
					this.menu.record = row.data;
					return this[action](this, e);
				}
			}
		}
		return this.processEvent('click', e);
	},
	_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();
		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {continue;}
			ids.push(selected[i]['id']);
		}
		return ids;
	}
});
Ext.reg('pisma-grid-newsletters', Pisma.grid.Newsletters);



Pisma.window.CreateNewsletter = function (config) {
	config = config || {};
	if (!config.id) {config.id = 'pisma-newsletter-window-create';}
	Ext.applyIf(config, {
		title: _('pisma_newsletter_create'),
		width: 550,
		autoHeight: true,
		url: Pisma.config.connector_url,
		action: 'mgr/newsletters/create',
		fields: [
			{xtype: 'textfield',fieldLabel: _('pisma_newsletter_title'),name: 'title',id: config.id + '-title',anchor: '99%',allowBlank: false},
			{xtype: 'textfield',fieldLabel: _('pisma_newsletter_docid'),name: 'docid',id: config.id + '-docid',anchor: '99%',allowBlank: false},
			{xtype: 'textarea',fieldLabel: _('pisma_newsletter_groups'),name: 'groups',id: config.id + '-groups',height: 150,anchor: '99%'},
			{xtype: 'textfield',fieldLabel: _('pisma_newsletter_attachment'),name: 'attachment',id: config.id + '-attachment',width: 300,anchor: '99%',allowBlank: true,inputType: 'file'}
		],
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	Pisma.window.CreateNewsletter.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.window.CreateNewsletter, MODx.Window);
Ext.reg('pisma-newsletter-window-create', Pisma.window.CreateNewsletter);