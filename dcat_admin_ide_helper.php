<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection roles
     * @property Grid\Column|Collection permissions
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection user
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection input
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection alias
     * @property Grid\Column|Collection authors
     * @property Grid\Column|Collection enable
     * @property Grid\Column|Collection imported
     * @property Grid\Column|Collection config
     * @property Grid\Column|Collection require
     * @property Grid\Column|Collection require_dev
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection month
     * @property Grid\Column|Collection usage
     * @property Grid\Column|Collection max_usage
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection tag
     * @property Grid\Column|Collection admin_user_id
     * @property Grid\Column|Collection expire_at
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection v2ray_qrcode
     * @property Grid\Column|Collection v2ray_vmess
     * @property Grid\Column|Collection bandwidth_usage_max
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection last_timestamp
     * @property Grid\Column|Collection date
     * @property Grid\Column|Collection downlink_byte
     * @property Grid\Column|Collection uplink_byte
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection attempts
     * @property Grid\Column|Collection available_at
     * @property Grid\Column|Collection reserved_at
     * @property Grid\Column|Collection email_verified_at
     * @property Grid\Column|Collection active_state
     * @property Grid\Column|Collection stat_updated_at
     * @property Grid\Column|Collection client_id
     * @property Grid\Column|Collection memo
     * @property Grid\Column|Collection state
     * @property Grid\Column|Collection value
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection roles(string $label = null)
     * @method Grid\Column|Collection permissions(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection user(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection input(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection alias(string $label = null)
     * @method Grid\Column|Collection authors(string $label = null)
     * @method Grid\Column|Collection enable(string $label = null)
     * @method Grid\Column|Collection imported(string $label = null)
     * @method Grid\Column|Collection config(string $label = null)
     * @method Grid\Column|Collection require(string $label = null)
     * @method Grid\Column|Collection require_dev(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection month(string $label = null)
     * @method Grid\Column|Collection usage(string $label = null)
     * @method Grid\Column|Collection max_usage(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection tag(string $label = null)
     * @method Grid\Column|Collection admin_user_id(string $label = null)
     * @method Grid\Column|Collection expire_at(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection v2ray_qrcode(string $label = null)
     * @method Grid\Column|Collection v2ray_vmess(string $label = null)
     * @method Grid\Column|Collection bandwidth_usage_max(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection last_timestamp(string $label = null)
     * @method Grid\Column|Collection date(string $label = null)
     * @method Grid\Column|Collection downlink_byte(string $label = null)
     * @method Grid\Column|Collection uplink_byte(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection attempts(string $label = null)
     * @method Grid\Column|Collection available_at(string $label = null)
     * @method Grid\Column|Collection reserved_at(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     * @method Grid\Column|Collection active_state(string $label = null)
     * @method Grid\Column|Collection stat_updated_at(string $label = null)
     * @method Grid\Column|Collection client_id(string $label = null)
     * @method Grid\Column|Collection memo(string $label = null)
     * @method Grid\Column|Collection state(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection username
     * @property Show\Field|Collection name
     * @property Show\Field|Collection roles
     * @property Show\Field|Collection permissions
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection user
     * @property Show\Field|Collection method
     * @property Show\Field|Collection path
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection input
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection version
     * @property Show\Field|Collection alias
     * @property Show\Field|Collection authors
     * @property Show\Field|Collection enable
     * @property Show\Field|Collection imported
     * @property Show\Field|Collection config
     * @property Show\Field|Collection require
     * @property Show\Field|Collection require_dev
     * @property Show\Field|Collection email
     * @property Show\Field|Collection month
     * @property Show\Field|Collection usage
     * @property Show\Field|Collection max_usage
     * @property Show\Field|Collection content
     * @property Show\Field|Collection tag
     * @property Show\Field|Collection admin_user_id
     * @property Show\Field|Collection expire_at
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection v2ray_qrcode
     * @property Show\Field|Collection v2ray_vmess
     * @property Show\Field|Collection bandwidth_usage_max
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection last_timestamp
     * @property Show\Field|Collection date
     * @property Show\Field|Collection downlink_byte
     * @property Show\Field|Collection uplink_byte
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection attempts
     * @property Show\Field|Collection available_at
     * @property Show\Field|Collection reserved_at
     * @property Show\Field|Collection email_verified_at
     * @property Show\Field|Collection active_state
     * @property Show\Field|Collection stat_updated_at
     * @property Show\Field|Collection client_id
     * @property Show\Field|Collection memo
     * @property Show\Field|Collection state
     * @property Show\Field|Collection value
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection roles(string $label = null)
     * @method Show\Field|Collection permissions(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection user(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection input(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection alias(string $label = null)
     * @method Show\Field|Collection authors(string $label = null)
     * @method Show\Field|Collection enable(string $label = null)
     * @method Show\Field|Collection imported(string $label = null)
     * @method Show\Field|Collection config(string $label = null)
     * @method Show\Field|Collection require(string $label = null)
     * @method Show\Field|Collection require_dev(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection month(string $label = null)
     * @method Show\Field|Collection usage(string $label = null)
     * @method Show\Field|Collection max_usage(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection tag(string $label = null)
     * @method Show\Field|Collection admin_user_id(string $label = null)
     * @method Show\Field|Collection expire_at(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection v2ray_qrcode(string $label = null)
     * @method Show\Field|Collection v2ray_vmess(string $label = null)
     * @method Show\Field|Collection bandwidth_usage_max(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection last_timestamp(string $label = null)
     * @method Show\Field|Collection date(string $label = null)
     * @method Show\Field|Collection downlink_byte(string $label = null)
     * @method Show\Field|Collection uplink_byte(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection attempts(string $label = null)
     * @method Show\Field|Collection available_at(string $label = null)
     * @method Show\Field|Collection reserved_at(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     * @method Show\Field|Collection active_state(string $label = null)
     * @method Show\Field|Collection stat_updated_at(string $label = null)
     * @method Show\Field|Collection client_id(string $label = null)
     * @method Show\Field|Collection memo(string $label = null)
     * @method Show\Field|Collection state(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     */
    class Show {}

    /**
     * @method \Dcat\Admin\Form\Field\Button button(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
