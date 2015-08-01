Pisma.grid.Groups = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'pisma-grid-groups';
	}
	Ext.applyIf(config, {
		url: modExtra.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {
			action: 'mgr/groups/getlist'
		},
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
				return !rec.data.active
					? 'pisma-grid-row-disabled'
					: '';
			}
		},
		paging: true,
		remoteSort: true,
		autoHeight: true,
	});
	Pisma.grid.Items.superclass.constructor.call(this, config);

	// Clear selection on grid refresh
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
};
Ext.extend(Pisma.grid.Groups, MODx.grid.Grid, {
	windows: {},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();
		var row = grid.getStore().getAt(rowIndex);
		var menu = modExtra.utils.getMenu(row.data['actions'], this, ids);
		this.addContextMenuItem(menu);
	},

	createItem: function (btn, e) {
		var w = MODx.load({
			xtype: 'pisma-groups-window-create',
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
				action: 'mgr/groups/get',
				id: id
			},
			listeners: {
				success: {
					fn: function (r) {
						var w = MODx.load({
							xtype: 'pisma-groups-window-update',
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
				? _('pisma_groups_remove')
				: _('pisma_group_remove'),
			text: ids.length > 1
				? _('pisma_groups_remove_confirm')
				: _('pisma_group_remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/pisma/remove',
				ids: Ext.util.JSON.encode(ids),
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

	getFields: function (config) {return ['id', 'active', 'email', 'firstname', 'lastname', 'signupdate', 'actions'];},

	getColumns: function (config) {
		return [{
			header: _('pisma_newsletters_id'),
			dataIndex: 'id',
			sortable: true,
			width: 70
		}, {
			header: _('pisma_groups_active'),
			dataIndex: 'active',
			renderer: modExtra.utils.renderBoolean,
			sortable: true,
			width: 70,
		}, {
			header: _('pisma_groups_email'),
			dataIndex: 'email',
			sortable: false,
			width: 150,
		}, {
			header: _('pisma_groups_firstname'),
			dataIndex: 'firstname',
			sortable: true,
			width: 100,
		}, {
			header: _('pisma_groups_lastname'),
			dataIndex: 'lastname',
			sortable: true,
			width: 100,
		}, {
			header: _('pisma_groups_signupdate'),
			dataIndex: 'signupdate',
			sortable: true,
			width: 100,
		}, {
			header: _('pisma_groups_actions'),
			dataIndex: 'actions',
			renderer: modExtra.utils.renderActions,
			sortable: false,
			width: 100,
			id: 'actions'
		}];
	},

	getTopBar: function (config) {
		return [{
			text: '<i class="icon icon-plus"></i>&nbsp;' + _('pisma_group_create'),
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
Ext.reg('pisma-grid-groups', modExtra.grid.Groups);