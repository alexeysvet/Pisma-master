Pisma.grid.Subscribers = function (config) {
	config = config || {};
	if (!config.id) {config.id = 'pisma-grid-subscribers';}
	Ext.applyIf(config, {
		url: Pisma.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {action: 'mgr/subscribers/getlist'},
		listeners: {
			rowDblClick: function (grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateItem(grid, e, row);
			}
		},
		viewConfig: {
			forceFit: true,
			enableRowBody: true,
			autoFill: true,
			showPreview: true,
			scrollOffset: 0,
			getRowClass: function (rec, ri, p) {
				return !rec.data.public
					? 'pisma-grid-row-disabled'
					: '';
			}
		},
		paging: true,
		remoteSort: true,
		autoHeight: true
	});
	Pisma.grid.Subscribers.superclass.constructor.call(this, config);
	// Clear selection on grid refresh
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
};
Ext.extend(Pisma.grid.Subscribers, MODx.grid.Grid, {
	windows: {},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();
		var row = grid.getStore().getAt(rowIndex);
		var menu = Pisma.utils.getMenu(row.data['actions'], this, ids);
		this.addContextMenuItem(menu);
	},

	createItem: function (btn, e) {
		var w = MODx.load({
			xtype: 'pisma-subscriber-window-create',
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

	updateItem: function (btn, e, row) {
		if (typeof(row) != 'undefined') {
			this.menu.record = row.data;
		}
		else if (!this.menu.record) {
			return false;
		}
		var id = this.menu.record.id;
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/subscribers/get',
				id: id
			},
			listeners: {
				success: {
					fn: function (r) {
						var w = MODx.load({
							xtype: 'pisma-subscriber-window-update',
							id: Ext.id(),
							record: r,
							listeners: {
								success: {
									fn: function () {
										this.refresh();
									}, scope: this
								}
							}
						});
						w.reset();
						w.setValues(r.object);
						w.show(e.target);
					}, scope: this
				}
			}
		});
	},

	removeItem: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.msg.confirm({
			title: ids.length > 1
				? _('pisma_subscribers_remove')
				: _('pisma_subscriber_remove'),
			text: ids.length > 1
				? _('pisma_subscribers_remove_confirm')
				: _('pisma_subscriber_remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/subscribers/remove',
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

	getFields: function (config) {return ['id', 'active', 'email', 'firstname', 'lastname', 'company', 'signupdate', 'actions'];},

	getColumns: function (config) {
		return [
			{header: _('pisma_id'),dataIndex: 'id',sortable: true,width: 40},
			{header: _('pisma_subscriber_active'),dataIndex: 'active',sortable: true,	width: 90,renderer: Pisma.utils.renderBoolean},
			{header: _('pisma_subscriber_email'),dataIndex: 'email',sortable: true,width: 120},
			{header: _('pisma_subscriber_firstname'),dataIndex: 'firstname',sortable: true,width: 100},
			{header: _('pisma_subscriber_lastname'),dataIndex: 'lastname',sortable: true,width: 100},
			{header: _('pisma_subscriber_company'),dataIndex: 'company',sortable: true,width: 100},
			{header: _('pisma_subscriber_signupdate'),dataIndex: 'signupdate',sortable: true,width: 100},
			{header: _('pisma_actions'),dataIndex: 'actions',sortable: false,width: 100,id: 'actions',renderer: Pisma.utils.renderActions}
		];
	},

	getTopBar: function (config) {
		return [{
			text: '<i class="icon icon-plus"></i>&nbsp;' + _('pisma_subscriber_create'),
			handler: this.createItem,
			scope: this
		}];
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
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push(selected[i]['id']);
		}

		return ids;
	}
});
Ext.reg('pisma-grid-subscribers', Pisma.grid.Subscribers);


Pisma.window.CreateSubscriber = function (config) {
	config = config || {};
	if (!config.id) {config.id = 'pisma-subscriber-window-create';}
	Ext.applyIf(config, {
		title: _('pisma_subscriber_create'),
		width: 550,
		autoHeight: true,
		url: Pisma.config.connector_url,
		action: 'mgr/subscribers/create',
		fields: [
			{xtype: 'textfield',fieldLabel: _('pisma_group_name'),name: 'name',id: config.id + '-name',anchor: '99%',allowBlank: false},
			{xtype: 'xcheckbox',boxLabel: _('pisma_group_public'),name: 'public',id: config.id + '-public',checked: false}
		],
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	Pisma.window.CreateSubscriber.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.window.CreateSubscriber, MODx.Window);
Ext.reg('pisma-subscriber-window-create', Pisma.window.CreateSubscriber);


Pisma.window.UpdateSubscriber = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'pisma-subscriber-window-update';
	}
	Ext.applyIf(config, {
		title: _('pisma_subscriber_update'),
		width: 550,
		autoHeight: true,
		url: Pisma.config.connector_url,
		action: 'mgr/subscribers/update',
		fields: [
			{xtype: 'textfield',fieldLabel: _('pisma_group_name'),name: 'name',id: config.id + '-name',anchor: '99%',allowBlank: false},
			{xtype: 'xcheckbox',boxLabel: _('pisma_group_public'),name: 'public',id: config.id + '-public',checked: false}
		],
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	Pisma.window.UpdateSubscriber.superclass.constructor.call(this, config);
};
Ext.extend(Pisma.window.UpdateSubscriber, MODx.Window);
Ext.reg('pisma-subscriber-window-update', Pisma.window.UpdateSubscriber);