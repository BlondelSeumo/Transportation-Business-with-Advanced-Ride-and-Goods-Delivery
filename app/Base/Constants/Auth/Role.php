<?php

namespace App\Base\Constants\Auth;

class Role
{
    const USER = 'user';
    const SUPER_ADMIN = 'super-admin';
    const ADMIN = 'admin';
    const SUB_ADMIN = 'sub-admin';
    const MANAGER = 'manager';
    const DRIVER = 'driver';
    const DISPATCHER = 'dispatcher';
    const OWNER = 'owner';
    const DELIVERY_DISPATCHER = 'delivery-dispatcher';



    /**
     * Get all the admin roles.
     *
     * @return array
     */
    public static function adminRoles()
    {
        return [
            self::SUPER_ADMIN,
            self::ADMIN,
            self::DISPATCHER,
            self::DELIVERY_DISPATCHER,
        ];
    }

    /* dispatchRoles */

        public static function dispatchRoles()
        {
            return [
                self::DISPATCHER,
                self::DELIVERY_DISPATCHER,
            ];
        }

    
    /**
     * Get all the admin roles.
     *
     * @return array
     */
    public static function exceptSuperAdminRoles()
    {
        return [
            self::ADMIN,
        ];
    }

    /**
     * Get all the web panel roles.
     *
     * @return array
     */
    public static function webPanelLoginRoles()
    {
        return [
            self::SUPER_ADMIN,
            self::ADMIN,
            self::OWNER,
        ];
    }
    /**
    * Get all the web panel roles.
    *
    * @return array
    */
    public static function webShowableRoles()
    {
        return [
            self::SUPER_ADMIN,
            self::ADMIN,
        ];
    }

    /**
     * Get all the Merchant and Admin roles
     * @return array
     */
    public static function masterDataAccessRoles()
    {
        return [
            self::ADMIN,
            self::SUPER_ADMIN,

        ];
    }

    /**
     * Get all the user and Admin roles
     * @return array
     */
    public static function userAndAdminRoles()
    {
        return [
            self::USER,
            self::SUPER_ADMIN,
            self::ADMIN,
        ];
    }

    /**
     * Get all the user and driver roles
     * @return array
     */
    public static function mobileAppRoles()
    {
        return [
            self::USER,
            self::DRIVER,
            self::OWNER,
        ];
    }
}
