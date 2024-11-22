<?php

namespace Database\Seeders;

use App\Base\Constants\Auth\Permission as PermissionSlug;
use App\Base\Constants\Auth\Role as RoleSlug;
use App\Models\Access\Permission;
use App\Models\Access\Role;
use Illuminate\Database\Seeder;
use DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
      * List of all the permissions to be created.
      *
      * @var array
      */

    protected $permissions = [

    //Dashboard and Configurations
       PermissionSlug::ACCESS_DASHBOARD => [
            'name' => 'Access-Dashboard',
            'description' => 'Access Dashboard',
            'main_menu' => 'dashboard',
            'sub_menu' => null,
            'sort' => 1,
            'main_link' => 'dashboard',
            'icon' => 'fa fa-tachometer'
        ],
        PermissionSlug::GET_ALL_ROLES => [
            'name' => 'Get-All-Roles',
            'description' => 'Get-All-Roles',
            'main_menu'=>'settings',
            'sub_menu'=>'roles',
            'sub_link'=>'roles',
        ],
        PermissionSlug::VIEW_ROLES => [
            'name' => 'view-roles',
            'description' => 'view-roles',
            'main_menu'=>'settings',
            'sub_menu'=>'roles',
            'sub_link'=>'roles',
        ],
        PermissionSlug::EDIT_ROLES => [
            'name' => 'edit-roles',
            'description' => 'Edit all roles',
            'main_menu'=>'settings',
            'sub_menu'=>'roles',
            'sub_link'=>'roles',
            ],
        PermissionSlug::CREATE_ROLES => [
            'name' => 'create-roles',
            'description' => 'Create Roles',
            'main_menu' => 'settings',
            'sub_menu' => null,
            'sort' => 12,
            'icon' => 'fa fa-cogs'
        ],
        PermissionSlug::CREATE_NEW_ROLE => [
            'name' => 'create-new-role',
            'description' => 'Create New Role',
            'main_menu' => 'settings',
            'sub_menu'=>'roles',
            'sub_link'=>'roles',
        ],
        PermissionSlug::GET_ALL_PERMISSIONS => [
            'name' => 'Get-All-Permissions',
            'description' => 'Get all permissions',
            'main_menu'=>'settings',
            'sub_menu'=>'roles',
        ],

        PermissionSlug::SETTINGS => [
            'name' => 'view-all-settings',
            'description' => 'View All Settings',
            'main_menu' => 'settings',
            'sub_menu' => null,
            'sort' => 12,
            'icon' => 'fa fa-cogs'
        ],
        PermissionSlug::VIEW_SYSTEM_SETINGS => [
            'name' => 'view-system-settings',
            'description' => 'view-system-settings',
            'main_menu' => 'settings',
            'sub_menu' => null,
            'sort' => 12,
            'icon' => 'fa fa-cogs'
        ],
        PermissionSlug::VIEW_TRANSLATIONS => [
            'name' => 'view-translations',
            'description' => 'View Translations',
            'main_menu' => 'settings',
            'sub_menu' => null,
            'sort' => 12,
            'icon' => 'fa fa-cogs'
        ],

    /**
     * Country Management
     * */
        PermissionSlug::MANAGE_COUNTRY => [
            'name' => 'manage-country',
            'description' => 'View Country',
            'main_menu'=>'settings',
            'sub_menu'=> 'country',
            'sub_link'=> 'country',
            'main_link'=>'settings',
        ],
        PermissionSlug::ADD_COUNTRY => [
            'name' => 'add-country',
            'description' => 'add Country',
            'main_menu'=>'settings',
            'sub_menu'=> 'country',
            'sub_link'=> 'country',
            'main_link'=>'settings',

        ],
        PermissionSlug::EDIT_COUNTRY => [
            'name' => 'edit-country',
            'description' => 'edit country',
            'main_menu'=>'settings',
            'sub_menu'=> 'country',
            'sub_link'=> 'country',
            'main_link'=>'settings',

        ],
        PermissionSlug::DELETE_COUNTRY => [
            'name' => 'delete-country',
            'description' => 'delete country',
            'main_menu'=>'settings',
            'sub_menu'=> 'country',
            'sub_link'=> 'country',
            'main_link'=>'settings',

        ],
        PermissionSlug::TOGGLE_COUNTRY => [
            'name' => 'toggle-country',
            'description' => 'toggle-country',
            'main_menu'=>'settings',
            'sub_menu'=> 'country',
            'sub_link'=> 'country',
            'main_link'=>'settings',
        ],
/* Master */
        PermissionSlug::MASTER => [
            'name' => 'master-data',
            'description' => 'View All Master Data',
            'main_menu' => 'master',
            'sub_menu' => null,
            'sort' => 17,
            'icon' => 'fa fa-code-fork'
        ],

   // Manage Driver Needed Doc
        PermissionSlug::MANAGE_DRIVER_NEEDED_DOC => [
            'name' => 'manage-driver-needed-document',
            'description' => 'List driver needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'needed_doc',
            'sub_link'=>'needed_doc',
        ],
        PermissionSlug::ADD_DRIVER_NEEEDED_DOC => [
            'name' => 'add-driver-needed-document',
            'description' => 'Add driver needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'needed_doc',
            'sub_link'=>'needed_doc',
        ],
        PermissionSlug::EDIT_DRIVER_NEEEDED_DOC => [
            'name' => 'edit-driver-needed-document',
            'description' => 'Edit driver needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'needed_doc',
            'sub_link'=>'needed_doc',
        ],
        PermissionSlug::DELETE_DRIVER_NEEEDED_DOC => [
            'name' => 'delete-driver-needed-document',
            'description' => 'Delete driver needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'needed_doc',
            'sub_link'=>'needed_doc',
        ],
        PermissionSlug::TOGGLE_DRIVER_NEEEDED_DOC => [
            'name' => 'toggle-driver-needed-documentt',
            'description' => 'toggle-driver-needed-document',
            'main_menu'=>'master',
            'sub_menu'=>'needed_doc',
            'sub_link'=>'needed_doc',
        ],
     //Manage Fleet Needed Doc
        PermissionSlug::MANAGE_FLEET_NEEDED_DOC => [
            'name' => 'manage-fleet_needed-document',
            'description' => 'List fleet needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'fleet_needed_doc',
            'sub_link'=>'fleet_needed_doc',
        ],
        PermissionSlug::ADD_FLEET_NEEEDED_DOC => [
            'name' => 'add-fleet-needed-document',
            'description' => 'Add fleet needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'fleet_needed_doc',
            'sub_link'=>'fleet_needed_doc',
        ],
        PermissionSlug::EDIT_FLEET_NEEEDED_DOC => [
            'name' => 'edit-fleet-needed-document',
            'description' => 'Edit fleet needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'fleet_needed_doc',
            'sub_link'=>'fleet_needed_doc',
        ],
        PermissionSlug::DELETE_FLEET_NEEEDED_DOC => [
            'name' => 'delete-fleet-needed-document',
            'description' => 'Delete fleet needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'fleet_needed_doc',
            'sub_link'=>'fleet_needed_doc',
        ],
        PermissionSlug::TOGGLE_FLEET_NEEEDED_DOC => [
            'name' => 'toggle-fleet-needed-documentt',
            'description' => 'toggle-fleet-needed-document',
            'main_menu'=>'master',
            'sub_menu'=>'fleet_needed_doc',
            'sub_link'=>'fleet_needed_doc',
        ],
        // Manage Owner Needed Doc
        PermissionSlug::MANAGE_OWNER_NEEDED_DOC => [
            'name' => 'manage-owner-needed-document',
            'description' => 'List owner needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'owner_needed_doc',
            'sub_link'=>'owner_needed_doc',
        ],
        PermissionSlug::ADD_OWNER_NEEEDED_DOC => [
            'name' => 'add-owner-needed-document',
            'description' => 'Add Owner needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'owner_needed_doc',
            'sub_link'=>'owner_needed_doc',
        ],
        PermissionSlug::EDIT_OWNER_NEEEDED_DOC => [
            'name' => 'edit-owner-needed-document',
            'description' => 'Edit Owner needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'owner_needed_doc',
            'sub_link'=>'owner_needed_doc',
        ],
        PermissionSlug::DELETE_OWNER_NEEEDED_DOC => [
            'name' => 'delete-owner-needed-document',
            'description' => 'Delete Owner needed documents',
            'main_menu'=>'master',
            'sub_menu'=>'owner_needed_doc',
            'sub_link'=>'owner_needed_doc',
        ],
        PermissionSlug::TOGGLE_OWNER_NEEEDED_DOC => [
            'name' => 'toggle-owner-needed-document',
            'description' => 'toggle Owner needed document',
            'main_menu'=>'master',
            'sub_menu'=>'owner_needed_doc',
            'sub_link'=>'owner_needed_doc',
        ],
        //Manage Package Type
        PermissionSlug::PACKAGE_TYPE => [
            'name' => 'manage-package-type',
            'description' => 'List Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'package-type',
            'sub_link'=>'package-type',
        ],
        PermissionSlug::ADD_PACKAGE_TYPE => [
            'name' => 'add-package-type',
            'description' => 'Add Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'package-type',
            'sub_link'=>'package-type',
        ],
        PermissionSlug::EDIT_PACKAGE_TYPE => [
            'name' => 'edit-package-type',
            'description' => 'Edit Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'package-type',
            'sub_link'=>'package-type',
        ],
        PermissionSlug::DELETE_PACKAGE_TYPE => [
            'name' => 'delete-package-type',
            'description' => 'Delete Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'package-type',
            'sub_link'=>'package-type',
        ],
        PermissionSlug::TOGGLE_PACKAGE_TYPE => [
            'name' => 'toggle-package-type',
            'description' => 'toggle Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'package-type',
            'sub_link'=>'package-type',
        ],
        //Manage Banner Image
        PermissionSlug::BANNER_IMAGE => [
            'name' => 'manage-banner-image',
            'description' => 'List Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'banner-image',
            'sub_link'=>'banner-image',
        ],
        PermissionSlug::ADD_BANNER_IMAGE => [
            'name' => 'add-banner-image',
            'description' => 'Add Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'banner-image',
            'sub_link'=>'banner-image',
        ],
        PermissionSlug::EDIT_BANNER_IMAGE => [
            'name' => 'edit-banner-image',
            'description' => 'Edit Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'banner-image',
            'sub_link'=>'banner-image',
        ],
        PermissionSlug::DELETE_BANNER_IMAGE => [
            'name' => 'delete-banner-image',
            'description' => 'Delete Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'banner-image',
            'sub_link'=>'banner-image',
        ],
        PermissionSlug::TOGGLE_BANNER_IMAGE => [
            'name' => 'toggle-banner-image',
            'description' => 'toggle Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'banner-image',
            'sub_link'=>'banner-image',
        ],
        //Manage Goods Type
        PermissionSlug::GOODS_TYPES => [
            'name' => 'manage-goods-types',
            'description' => 'List Package Type',
            'main_menu'=>'master',
            'sub_menu'=>'goods_types',
            'sub_link'=>'goods_types',
        ],
        PermissionSlug::ADD_GOODS_TYPES => [
            'name' => 'add-goods-typess',
            'description' => 'Add Goods Types',
            'main_menu'=>'master',
            'sub_menu'=>'goods_types',
            'sub_link'=>'goods_types',
        ],
        PermissionSlug::EDIT_GOODS_TYPES => [
            'name' => 'edit-goods-types',
            'description' => 'Edit Goods Types',
            'main_menu'=>'master',
            'sub_menu'=>'goods_types',
            'sub_link'=>'goods_types',
        ],
        PermissionSlug::DELETE_GOODS_TYPES => [
            'name' => 'delete-goods-types',
            'description' => 'Delete Goods Types',
            'main_menu'=>'master',
            'sub_menu'=>'goods_types',
            'sub_link'=>'goods_types',
        ],
        PermissionSlug::TOGGLE_GOODS_TYPES => [
            'name' => 'toggle-goods-types',
            'description' => 'toggle Goods Types',
            'main_menu'=>'master',
            'sub_menu'=>'goods_types',
            'sub_link'=>'goods_types',
        ],
      /* service-Location */
        PermissionSlug::SERVICE_LOCATION => [
            'name' => 'Service_Location',
            'description' => 'Available location for app',
            'main_menu'=>'service_location',
            'sub_menu'=> null,
            'main_link'=>'service_location',
            'sort' => 2,
            'icon' => 'fa fa-map-marker'
        ],
        PermissionSlug::ADD_SERVICE_LOCATION => [
            'name' => 'Add_Service_Location',
            'description' => 'Add location for app',
            'main_menu'=>'service_location',
            'sub_menu'=> null,
            'main_link'=>'service_location',
            'sort' => 2,
            'icon' => 'fa fa-map-marker'
        ],
        PermissionSlug::EDIT_SERVICE_LOCATION => [
            'name' => 'Edit_Service_Location',
            'description' => 'Edit location for app',
            'main_menu'=>'service_location',
            'sub_menu'=> null,
            'main_link'=>'service_location',
            'sort' => 2,
            'icon' => 'fa fa-map-marker'
        ],
        PermissionSlug::DELETE_SERVICE_LOCATION => [
            'name' => 'Delete_Service_Location',
            'description' => 'Delete location for app',
            'main_menu'=>'service_location',
            'sub_menu'=> null,
            'main_link'=>'service_location',
            'sort' => 2,
            'icon' => 'fa fa-map-marker'
        ],
        PermissionSlug::TOGGLE_SERVICE_LOCATION => [
            'name' => 'Toggle_Service_Location',
            'description' => 'toggle location for app',
            'main_menu'=>'service_location',
            'sub_menu'=> null,
            'main_link'=>'service_location',
            'sort' => 2,
            'icon' => 'fa fa-map-marker'
        ],
    /* manage-owner */
         PermissionSlug::MANAGE_OWNER => [
            'name' => 'manage_owners',
            'description' => 'Owner list and create',
            'main_menu' => 'manage_owners',
            'sub_menu' => 'owner',
            'sort' => 3,
            'icon' => 'fa fa-briefcase',
            'main_link' => 'owners',
        ],
        PermissionSlug::CREATE_OWNER => [
            'name' => 'add-owner',
            'description' => 'Add Owner',
            'main_menu' => 'manage_owners',
            'sub_menu' => 'owner'
        ],
        PermissionSlug::EDIT_OWNER => [
            'name' => 'edit-owner',
            'description' => 'Edit Owner',
            'main_menu' => 'manage_owners',
            'sub_menu' => 'owner'
        ],
        PermissionSlug::DELETE_OWNER => [
            'name' => 'delete-owner',
            'description' => 'Delete Owner',
            'main_menu' => 'manage_owners',
            'sub_menu' => 'owner'
        ],
        PermissionSlug::TOGGLE_OWNER_STATUS => [
            'name' => 'toggle-owner-status',
            'description' => 'Toggle Owner Status',
            'main_menu' => 'manage_owners',
            'sub_menu' => 'owner'
        ],
        PermissionSlug::VIEW_OWNER_DOCUMENT => [
            'name' => 'view-owner-document',
            'description' => 'View Owner Document',
            'main_menu' => 'manage_owners',
            'sub_menu' => 'owner'
        ],

  /* Manage Fleet */
         PermissionSlug::MANAGE_FLEET => [
            'name' => 'manage-fleet',
            'description' => 'Manage fleets add edit delete',
            'main_menu' => 'manage_fleet',
            'sub_menu' => null,
            'sort' => 18,
            'icon' => 'fa fa-taxi',
            'main_link' => 'fleets',
        ],
        PermissionSlug::CREATE_FLEET => [
            'name' => 'add-fleet',
            'description' => 'Create new fleet',
            'main_menu' => 'manage_fleet',
            'sub_menu' => 'manage_fleet'
        ],
        PermissionSlug::EDIT_FLEET => [
            'name' => 'edit-fleet',
            'description' => 'Edit fleet',
            'main_menu' => 'manage_fleet',
            'sub_menu' => 'manage_fleet'
        ],
        PermissionSlug::DELETE_FLEET => [
            'name' => 'delete-fleet',
            'description' => 'Delete fleet',
            'main_menu' => 'manage_fleet',
            'sub_menu' => 'manage_fleet'
        ],
        PermissionSlug::FLEET_TOGGLE_STATUS => [
            'name' => 'toggle-fleet-status',
            'description' => 'Change status of fleet',
            'main_menu' => 'manage_fleet',
            'sub_menu' => 'manage_fleet'
        ],
        PermissionSlug::FLEET_APPROVE_STATUS => [
            'name' => 'toggle-fleet-approval',
            'description' => 'Change Approve status of fleet',
            'main_menu' => 'manage_fleet',
            'sub_menu' => 'manage_fleet'
        ],
        PermissionSlug::VIEW_FLEET_DOCUMENT => [
            'name' => 'view-fleet-document',
            'description' => 'View Fleet Document',
            'main_menu' => 'manage_fleet',
            'sub_menu' => 'manage_fleet'
        ],
/* Admin */
        PermissionSlug::ADMIN => [
            'name' => 'Admin',
            'description' => 'Admin User List',
            'main_menu'=>'admin',
            'sub_menu'=> null,
            'main_link'=>'admins',
            'sort' => 3,
            'icon' => 'fa fa-user-circle-o'
        ],
        PermissionSlug::CREATE_ADMIN => [
            'name' => 'add-admin',
            'description' => 'create admin',
            'main_menu'=>'admin',
            'sub_menu'=> null,
            'main_link'=>'admins',
            'sort' => 3,
            'icon' => 'fa fa-user-circle-o'
        ],
        PermissionSlug::EDIT_ADMIN => [
            'name' => 'edit-admin',
            'description' => 'Edit Admin',
            'main_menu'=>'admin',
            'sub_menu'=> null,
            'main_link'=>'admins',
            'sort' => 3,
            'icon' => 'fa fa-user-circle-o'
        ],
        PermissionSlug::DELETE_ADMIN => [
            'name' => 'delete-admin',
            'description' => 'Delete Admin',
            'main_menu'=>'admin',
            'sub_menu'=> null,
            'main_link'=>'admins',
            'sort' => 3,
            'icon' => 'fa fa-user-circle-o'
        ],
        PermissionSlug::TOGGLE_ADMIN => [
            'name' => 'toggle-admin-status',
            'description' => 'toggle status admin',
            'main_menu'=>'admin',
            'sub_menu'=> null,
            'main_link'=>'admins',
            'sort' => 3,
            'icon' => 'fa fa-user-circle-o'
        ],
/* Request */
         PermissionSlug::VIEW_REQUEST => [
            'name' => 'view-requests',
            'description' => 'View Request Details',
            'main_menu'=>'request',
            'sub_menu'=> 'request',
            'main_link'=>'requests',
            'sort' => 5,
            'icon' => 'fa fa-list'
        ],
        PermissionSlug::RIDES => [
            'name' => 'view-rides',
            'description' => 'View Rides',
            'main_menu'=>'request',
            'sub_menu'=> 'request',
            'main_link'=>'requests',
            'sort' => 5,
            'icon' => 'fa fa-list'
        ],
        PermissionSlug::SCHEDULED_RIDES => [
            'name' => 'scheduled-rides',
            'description' => 'View scheduled Rides',
            'main_menu'=>'request',
            'sub_menu'=> 'scheduled-rides',
            'main_link'=>'requests',
            'sub_link' =>'scheduled-rides',
            'sort' => 5,
            'icon' => 'fa fa-list'
        ],
        PermissionSlug::CANCELLATION_RIDES => [
            'name' => 'cancellation-rides',
            'description' => 'View cancellation Rides',
            'main_menu'=>'request',
            'sub_menu'=> 'cancellation-rides',
            'main_link'=>'requests',
            'sub_link' =>'cancellation-rides',
            'sort' => 5,
            'icon' => 'fa fa-list'
        ],

/* Vehicle Type */

        PermissionSlug::VIEW_TYPES => [
            'name' => 'view-vehicle-types',
            'description' => 'Get all types',
            'main_menu'=>'vehicle-type',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'types',

        ],
        PermissionSlug::ADD_TYPES => [
            'name' => 'add-vehicle-types',
            'description' => 'Get all types',
            'main_menu'=>'vehicle-type',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'types',

        ],
        PermissionSlug::EDIT_TYPES => [
            'name' => 'edit-vehicle-types',
            'description' => 'Get all types',
            'main_menu'=>'vehicle-type',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'types',

        ],
        PermissionSlug::DELETE_TYPES => [
            'name' => 'delete-vehicle-types',
            'description' => 'Get all types',
            'main_menu'=>'vehicle-type',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'types',

        ],
        PermissionSlug::TOGGLE_TYPES => [
            'name' => 'toggle-vehicle-types',
            'description' => 'Get all types',
            'main_menu'=>'vehicle-type',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'types',
        ],
 /* Zone */
        PermissionSlug::MAP_MENU => [
            'name' => 'map',
            'description' => 'View all map related menus',
            'main_menu' => 'map',
            'sub_menu' => null,
            'sort' => 8,
            'icon' => 'fa fa-map'
        ],
        PermissionSlug::VIEW_ZONE_MAP => [
            'name' => 'view-zone-map',
            'description' => 'map-view',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
        PermissionSlug::VIEW_ZONE => [
            'name' => 'Get-All-zones',
            'description' => 'Get all zones',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
        PermissionSlug::ADD_ZONE => [
            'name' => 'add-zones',
            'description' => 'Add zones',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
        PermissionSlug::EDIT_ZONE => [
            'name' => 'edit-zones',
            'description' => 'Edit zones',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
        PermissionSlug::DELETE_ZONE => [
            'name' => 'delete-zones',
            'description' => 'Get all zones',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
        PermissionSlug::TOGGLE_ZONE => [
            'name' => 'toggle-status-zones',
            'description' => 'Toggle Status Zones',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
        PermissionSlug::SURGE_ZONE => [
            'name' => 'surge-zones',
            'description' => 'Surge zones',
            'main_menu'=>'map',
            'sub_menu'=>'zone',
            'sub_link'=>'zone',
        ],
         PermissionSlug::LIST_AIRPORTS => [
            'name' => 'Get-All-Airports',
            'description' => 'Get all airports',
            'main_menu'=>'map',
            'sub_menu'=>'airport',
            'sub_link'=>'aiports',
        ],
        PermissionSlug::ADD_AIRPORTS => [
            'name' => 'Add-Airports',
            'description' => 'Add airports',
            'main_menu'=>'map',
            'sub_menu'=>'airport',
            'sub_link'=>'aiports',
        ],
        PermissionSlug::EDIT_AIRPORTS => [
            'name' => 'Edit-Airports',
            'description' => 'Edit airports',
            'main_menu'=>'map',
            'sub_menu'=>'airport',
            'sub_link'=>'aiports',
        ],
        PermissionSlug::DELETE_AIRPORTS => [
            'name' => 'Delete-Airports',
            'description' => 'Delete airports',
            'main_menu'=>'map',
            'sub_menu'=>'airport',
            'sub_link'=>'aiports',
        ],
        PermissionSlug::MAP_VIEW_AIRPORTS => [
            'name' => 'Map-view-Airports',
            'description' => 'Map-view-Airports',
            'main_menu'=>'map',
            'sub_menu'=>'airport',
            'sub_link'=>'aiports',
        ],
        PermissionSlug::TOGGLE_AIRPORTS => [
            'name' => 'Toggle-Airports',
            'description' => 'Toggle-Airports',
            'main_menu'=>'map',
            'sub_menu'=>'airport',
            'sub_link'=>'aiports',
        ],
/* Vehicle Fare */

        PermissionSlug::VEHICLE_FARE => [
            'name' => 'vehicle-fare',
            'description' => 'list-vehicle_fare',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',

        ],
        PermissionSlug::ADD_PRICE => [
            'name' => 'add-price',
            'description' => 'add price',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',

        ],
        PermissionSlug::EDIT_PRICE => [
            'name' => 'edit-price',
            'description' => 'edit price',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',

        ],
        PermissionSlug::DELETE_PRICE => [
            'name' => 'delete-price',
            'description' => 'delete price',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',

        ],
        PermissionSlug::TOGGLE_PRICE => [
            'name' => 'toggle-price',
            'description' => 'toggle price',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::DEFAULT_VEHICLE_TYPE => [
            'name' => 'default-vehicle-type',
            'description' => 'default-vehicle-type',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::ASSIGN_RENTAL_PACKAGE => [
            'name' => 'assign-rental-package',
            'description' => 'assign-rental-package',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::RENTAL_PACKAGE => [
            'name' => 'rental-package',
            'description' => 'rental-package',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::ADD_RENTAL_PACKAGE => [
            'name' => 'add-rental-package',
            'description' => 'add-rental-package',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::EDIT_RENTAL_PACKAGE => [
            'name' => 'edit-rental-package',
            'description' => 'edit-rental-package',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::DELETE_RENTAL_PACKAGE => [
            'name' => 'delete-rental-package',
            'description' => 'delete-rental-package',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],
        PermissionSlug::TOGGLE_RENTAL_PACKAGE => [
            'name' => 'toggle-rental-package',
            'description' => 'toggle-rental-package',
            'main_menu'=>'vehicle-fare',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'vehicle_fare',
        ],

/* Drivers */
        PermissionSlug::DRIVERS_MENU => [
            'name' => 'drivers-menu',
            'description' => 'drivers',
            'main_menu' => 'drivers',
            'sub_menu' => null,
            'sort' => 4,
            'icon' => 'fa fa-users'
        ],
        PermissionSlug::VIEW_DRIVERS => [
            'name' => 'view-drivers',
            'description' => 'Get all drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::VIEW_PPROVAL_PENDING_DRIVERS => [
            'name' => 'view-approval-pending-drivers',
            'description' => 'Get-All-approval-pending-Drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::VIEW_DRIVER_RATINGS => [
            'name' => 'view-driver-ratings',
            'description' => 'Get all Drivers-Ratings',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::VIEW_DRIVER_WITHDRAWAL_REQUESTS => [
            'name' => 'view-driver-withdrawal-requests',
            'description' => 'Get all Drivers-withdrawal-request',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::VIEW_NEGATIVE_BALANCE_DRIVERS => [
            'name' => 'view-negative-balance-drivers',
            'description' => 'Get all-Negative-Balance-Drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::EDIT_DRIVERS => [
            'name' => 'edit-drivers',
            'description' => 'edit-drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::TOGGLE_DRIVERS => [
            'name' => 'toggle-drivers',
            'description' => 'toggle-drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::VIEW_REQUEST_LIST => [
            'name' => 'view-request-list',
            'description' => 'view-request-list',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::DRIVER_PAYMENT_HISTORY => [
            'name' => 'driver-payment-history',
            'description' => 'driver-payment-history',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::VIEW_DRIVER_PROFILE => [
            'name' => 'view-driver-profile',
            'description' => 'view-profile',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::ADD_DRIVERS => [
            'name' => 'add-drivers',
            'description' => 'add-drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::UPDATE_DRIVERS => [
            'name' => 'update-drivers',
            'description' => 'update-drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
        PermissionSlug::DELETE_DRIVERS => [
            'name' => 'delete-drivers',
            'description' => 'delete-drivers',
            'main_menu'=>'drivers',
            'sub_menu'=>'driver_details',
            'sub_link'=>'drivers',
        ],
    /* Driver Document */
    PermissionSlug::DRIVER_DOCUMENT => [
        'name' => 'driver-document',
        'description' => 'driver-document',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
    PermissionSlug::DRIVER_DOCUMENT_VIEW_IMAGE => [
        'name' => 'driver-document-view-image',
        'description' => 'driver-document-view',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
    PermissionSlug::DRIVER_DOCUMENT_EDIT => [
        'name' => 'driver-document-edit',
        'description' => 'driver-document-edit',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
    PermissionSlug::DRIVER_DOCUMENT_TOGGLE => [
        'name' => 'driver-document-toggle',
        'description' => 'driver-document-toggle',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
/* Driver Rating & Withdrwal Request */
    PermissionSlug::VIEW_DRIVER_RATING => [
        'name' => 'view-driver-rating',
        'description' => 'view-driver-rating',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
    PermissionSlug::DRIVER_WITHDRAWAL_REQUEST_VIEW => [
        'name' => 'driver-withdrwal-request-view',
        'description' => 'driver-withdrwal-request-view',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
/* Negative Balance Driver */

    PermissionSlug::NEGATIVE_BALACE_DRIVER_VIEW => [
        'name' => 'neagtive-driver-view',
        'description' => 'neagtive-driver-view',
        'main_menu'=>'drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'drivers',
    ],
/* Fleet Drivers  */
    PermissionSlug::FLEET_DRIVERS_MENU => [
        'name' => 'fleet-drivers-menu',
        'description' => 'fleet-drivers',
        'main_menu' => 'fleet-drivers',
        'sub_menu' => null,
        'sort' => 4,
        'icon' => 'fa fa-users'
    ],
    PermissionSlug::VIEW_APPROVED_FLEET_DRIVERS => [
        'name' => 'view-approved-drivers',
        'description' => 'Get all drivers',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::FLEET_DRIVERS_WAITING_FOR_APPROVAL => [
        'name' => 'fleet-drivers-waiting-for-approval',
        'description' => 'fleet-drivers-waiting-for-approval',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::EDIT_FLEET_DRIVERS => [
        'name' => 'edit-fleet-drivers',
        'description' => 'edit-fleet-drivers',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::TOGGLE_FLEET_DRIVERS => [
        'name' => 'toggle-fleet-drivers',
        'description' => 'toggle-fleet-drivers',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::UPDATE_FLEET_DRIVERS => [
        'name' => 'update-fleet-drivers',
        'description' => 'update-fleet-drivers',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::DELETE_FLEET_DRIVERS => [
        'name' => 'delete-fleet-drivers',
        'description' => 'delete-fleet-drivers',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::ADD_FLEET_DRIVERS => [
        'name' => 'add-fleet-drivers',
        'description' => 'add-fleet-drivers',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::VIEW_FLEET_DRIVER_REQUEST_LIST => [
        'name' => 'view-fleet-driver-request-list',
        'description' => 'view-fleet-driver-request-list',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::FLEET_DRIVER_PAYMENT_HISTORY => [
        'name' => 'fleet-driver-payment-history',
        'description' => 'fleet-driver-payment-history',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::VIEW_FLEET_DRIVER_PROFILE => [
        'name' => 'view-fleet-driver-profile',
        'description' => 'view-fleet-driver-profile',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    /*Fleet Driver Document */
    PermissionSlug::FLEET_DRIVER_DOCUMENT => [
        'name' => 'fleet-driver-document',
        'description' => 'fleet-driver-document',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::FLEET_DRIVER_DOCUMENT_VIEW_IMAGE => [
        'name' => 'fleet-driver-document-view-image',
        'description' => 'fleet-driver-document-view',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::FLEET_DRIVER_DOCUMENT_EDIT => [
        'name' => 'fleet-driver-document-edit',
        'description' => 'fleet-driver-document-edit',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::FLEET_DRIVER_DOCUMENT_UPLOAD => [
        'name' => 'fleet-driver-document-upload',
        'description' => 'fleet-driver-document-upload',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
    PermissionSlug::FLEET_DRIVER_DOCUMENT_TOGGLE => [
        'name' => 'fleet-driver-document-toggle',
        'description' => 'fleet-driver-document-toggle',
        'main_menu'=>'fleet-drivers',
        'sub_menu'=>'fleet-driver_details',
        'sub_link'=>'fleet-drivers',
    ],
/* Users */
    PermissionSlug::USER_MENU => [
        'name' => 'user-menu',
        'description' => 'View all user related menus',
        'main_menu' => 'users',
        'sub_menu' => null,
        'sort' => 5,
        'icon' => 'fa fa-user'
    ],
    PermissionSlug::VIEW_USERS => [
        'name' => 'Get-All-Users',
        'description' => 'Get all Users',
        'main_menu'=>'users',
        'sub_menu'=>'user_details',
        'sub_link'=>'users',
    ],
    PermissionSlug::ADD_USER => [
        'name' => 'add-users',
        'description' => 'add user',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',

    ],
    PermissionSlug::EDIT_USER => [
        'name' => 'edit-user',
        'description' => 'edit user',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',

    ],
    PermissionSlug::DELETE_USER => [
        'name' => 'delete-user',
        'description' => 'delete user',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',

    ],
    PermissionSlug::TOGGLE_USER => [
        'name' => 'toggle-user',
        'description' => 'toggle-user',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',
    ],
    PermissionSlug::VIEW_USER_REQUEST_LIST => [
        'name' => 'view-user-request-list',
        'description' => 'view-user-request-list',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',
    ],
    PermissionSlug::USER_PAYMENT_HISTORY => [
        'name' => 'user-payment-history',
        'description' => 'user-payment-history',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',
    ],
    PermissionSlug::VIEW_DELETED_USERS => [
        'name' => 'view-deleted-users',
        'description' => 'view-deleted-users',
        'main_menu'=>'users',
        'sub_menu'=>null,
        'sub_link'=>null,
        'main_link'=>'users',
    ],

/* SOS */
        PermissionSlug::VIEW_SOS => [
            'name' => 'view-sos',
            'description' => 'Emergency Numbers',
            'main_menu'=>'sos',
            'sub_menu'=> null,
            'main_link'=>'sos',
            'sort' => 6,
            'icon' => 'fa fa-heartbeat'
        ],
        PermissionSlug::ADD_SOS => [
            'name' => 'add-sos',
            'description' => 'add sos',
            'main_menu'=>'sos',
            'main_link'=>'sos',

        ],
        PermissionSlug::EDIT_SOS => [
            'name' => 'edit-sos',
            'description' => 'edit sos',
            'main_menu'=>'sos',
            'main_link'=>'sos',

        ],
        PermissionSlug::DELETE_SOS => [
            'name' => 'delete-sos',
            'description' => 'delete sos',
            'main_menu'=>'sos',
            'main_link'=>'sos',

        ],
        PermissionSlug::TOGGLE_SOS => [
            'name' => 'toggle-sos',
            'description' => 'toggle-sos',
            'main_menu'=>'sos',
            'main_link'=>'sos',
        ],
    // manage-promo
        PermissionSlug::MANAGE_PROMO => [
            'name' => 'manage-promo',
            'description' => 'View Promo code',
            'main_menu'=>'promo',
            'sub_menu'=> null,
            'main_link'=>'promo',
            'sort' => 10,
            'icon' => 'fa fa-gift'
        ],
        PermissionSlug::ADD_PROMO => [
            'name' => 'add-promo',
            'description' => 'add Promo code',
            'main_menu'=>'promo',
            'sub_menu'=> null,
            'sub_link'=>null,
            'main_link'=>'promo',

        ],
        PermissionSlug::EDIT_PROMO => [
            'name' => 'edit-promo',
            'description' => 'edit promo',
            'main_menu'=>'promo',
            'main_link'=>'promo',

        ],
        PermissionSlug::DELETE_PROMO => [
            'name' => 'delete-promo',
            'description' => 'delete promo',
            'main_menu'=>'promo',
            'main_link'=>'promo',

        ],
        PermissionSlug::TOGGLE_PROMO => [
            'name' => 'toggle-promo',
            'description' => 'toggle-promo',
            'main_menu'=>'promo',
            'main_link'=>'promo',
        ],
//Notifications
         PermissionSlug::NOTIFICATIONS => [
            'name' => 'notifications',
            'description' => 'notifications',
            'main_menu'=>'notifications',
            'main_link'=>'notifications',

        ],
        PermissionSlug::VIEW_NOTIFICATIONS => [
            'name' => 'view-notifications',
            'description' => 'view notifications',
            'main_menu'=>'notifications',
            'main_link'=>'notifications',

        ],
        PermissionSlug::SEND_PUSH => [
            'name' => 'send-push',
            'description' => 'toggle-promo',
            'main_menu'=>'notifications',
            'main_link'=>'notifications',
        ],
        PermissionSlug::DELETE_NOTIFICATIONS => [
            'name' => 'delete-notification',
            'description' => 'delete-notifications',
            'main_menu'=>'notifications',
            'main_link'=>'notifications',
        ],
    // manage-FAQ

         PermissionSlug::MANAGE_FAQ => [
            'name' => 'manage-faq',
            'description' => 'View Promo code',
            'main_menu'=>'faq',
            'sub_menu'=> null,
            'sub_link'=>null,
            'main_link'=>'faq',
            'icon' => 'fa fa-gift'
        ],
        PermissionSlug::ADD_FAQ => [
            'name' => 'add-faq',
            'description' => 'add Promo code',
            'main_menu'=>'faq',
            'sub_menu'=> null,
            'sub_link'=>null,
            'main_link'=>'faq',

        ],
        PermissionSlug::EDIT_FAQ => [
            'name' => 'edit-faq',
            'description' => 'edit faq',
            'main_menu'=>'faq',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'faq',

        ],
        PermissionSlug::DELETE_FAQ => [
            'name' => 'delete-faq',
            'description' => 'delete faq',
            'main_menu'=>'faq',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'faq',

        ],
        PermissionSlug::TOGGLE_FAQ => [
            'name' => 'toggle-faq',
            'description' => 'toggle-faq',
            'main_menu'=>'faq',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'faq',
        ],
    // manage-cancellation reason

         PermissionSlug::CANCELLATION_REASON => [
            'name' => 'manage-cancellation',
            'description' => 'View Promo code',
            'main_menu'=>'cancellation',
            'sub_menu'=> null,
            'sub_link'=>null,
            'main_link'=>'cancellation',
            'icon' => 'fa fa-gift'
        ],
        PermissionSlug::ADD_CANCELLATION => [
            'name' => 'add-cancellation',
            'description' => 'add cancellation',
            'main_menu'=>'cancellation',
            'sub_menu'=> null,
            'sub_link'=>null,
            'main_link'=>'cancellation',

        ],
        PermissionSlug::EDIT_CANCELLATION => [
            'name' => 'edit-cancellation',
            'description' => 'edit cancellation',
            'main_menu'=>'cancellation',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'cancellation',

        ],
        PermissionSlug::DELETE_CANCELLATION => [
            'name' => 'delete-cancellation',
            'description' => 'delete cancellation',
            'main_menu'=>'cancellation',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'cancellation',

        ],
        PermissionSlug::TOGGLE_CANCELLATION => [
            'name' => 'toggle-cancellation',
            'description' => 'toggle-cancellation',
            'main_menu'=>'cancellation',
            'sub_menu'=>null,
            'sub_link'=>null,
            'main_link'=>'cancellation',
        ],

/*complaint*/
        PermissionSlug::COMPLAINTS => [
            'name' => 'complaints',
            'description' => 'View Complaints',
            'main_menu'=>'complaints',
            'sub_menu'=> null,
            'main_link'=>'complaint',
            'sort' => 15,
            'icon' => 'fa fa-list-alt'
        ],
        PermissionSlug::USER_COMPLAINT => [
            'name' => 'user-complaint',
            'description' => 'Manange User Complaint',
            'main_menu'=>'complaints',
            'sub_menu'=> 'user-complaint',
            'sub_link'=>'complaint/users',
            'sort' => 15.2,
            'icon' => 'fa fa-circle-thin'
        ],
        PermissionSlug::DRIVER_COMPLAINT => [
            'name' => 'driver-complaint',
            'description' => 'Manage Driver Complaint',
            'main_menu'=>'complaints',
            'sub_menu'=> 'driver-complaint',
            'sub_link'=>'complaint/drivers',
            'sort' => 15.3,
            'icon' => 'fa fa-circle-thin'
        ],
        PermissionSlug::OWNER_COMPLAINT => [
            'name' => 'owner-complaint',
            'description' => 'Manage Owner Complaint',
            'main_menu'=>'complaints',
            'sub_menu'=> 'owner-complaint',
            'sub_link'=>'complaint/owner',
            'sort' => 15.3,
            'icon' => 'fa fa-circle-thin'
        ],
/*complaint-title*/

      PermissionSlug::COMPLAINT_TITLE => [
            'name' => 'complaint-title',
            'description' => 'View Complaint Title',
            'main_menu'=>'complaints',
            'sub_menu'=> 'complaint-title',
            'sub_link'=>'complaint/title',
            'sort' => 15.1,
            'icon' => 'fa fa-circle-thin'
        ],

      PermissionSlug::ADD_COMPLAINT_TITLE => [
            'name' => 'add-complaint-title',
            'description' => 'View Complaint Title',
            'main_menu'=>'complaints',
            'sub_menu'=> 'complaint-title',
            'sub_link'=>'complaint/title',
            'sort' => 15.1,
        ],
      PermissionSlug::EDIT_COMPLAINT_TITLE => [
            'name' => 'edit-complaint-title',
            'description' => 'View Complaint Title',
            'main_menu'=>'complaints',
            'sub_menu'=> 'complaint-title',
            'sub_link'=>'complaint/title',
            'sort' => 15.1,
        ],
      PermissionSlug::DELETE_COMPLAINT_TITLE => [
            'name' => 'delete-complaint-title',
            'description' => 'View Complaint Title',
            'main_menu'=>'complaints',
            'sub_menu'=> 'complaint-title',
            'sub_link'=>'complaint/title',
            'sort' => 15.1,
        ],
      PermissionSlug::TOGGLE_COMPLAINT_TITLE => [
            'name' => 'toggle-complaint-title',
            'description' => 'View Complaint Title',
            'main_menu'=>'complaints',
            'sub_menu'=> 'complaint-title',
            'sub_link'=>'complaint/title',
            'sort' => 15.1,
        ],
/*Reports*/

        PermissionSlug::REPORTS => [
            'name' => 'reports',
            'description' => 'View reports',
            'main_menu'=>'reports',
            'sub_menu'=> null,
            'main_link'=>'reports',
            'sort' => 16,
            'icon' => 'fa fa-file-pdf-o'
        ],
        PermissionSlug::USER_REPORT => [
            'name' => 'user-report',
            'description' => 'Download User Report',
            'main_menu'=>'reports',
            'sub_menu'=> 'user_report',
            'sub_link'=>'reports/user',
            'sort' => 16.1,
            'icon' => 'fa fa-circle-thin'
        ],
        PermissionSlug::DRIVER_REPORT => [
            'name' => 'driver-report',
            'description' => 'Download Driver Report',
            'main_menu'=>'reports',
            'sub_menu'=> 'driver_report',
            'sub_link'=>'reports/driver',
            'sort' => 16.2,
            'icon' => 'fa fa-circle-thin'
        ],
        PermissionSlug::FINANCE_REPORT => [
            'name' => 'finance-report',
            'description' => 'Download Finance Report',
            'main_menu'=>'reports',
            'sub_menu'=> 'travel_report',
            'sub_link'=>'reports/travel',
            'sort' => 16.3,
            'icon' => 'fa fa-circle-thin'
        ],
        PermissionSlug::OWNER_REPORT => [
            'name' => 'owner-report',
            'description' => 'Download Owner Report',
            'main_menu'=>'reports',
            'sub_menu'=> 'owner_report',
            'sub_link'=>'reports/owner',
            'sort' => 16.3,
            'icon' => 'fa fa-circle-thin'
        ],
        PermissionSlug::DRIVER_DUTIES_REPORT => [
            'name' => 'driver-duities-report',
            'description' => 'Download driver-duities-report',
            'main_menu'=>'reports',
            'sub_menu'=> 'driver_report',
            'sub_link'=>'reports/driver',
            'sort' => 16.2,
            'icon' => 'fa fa-circle-thin'
        ],
/*geo-fencing*/
        PermissionSlug::MANAGE_MAP => [
            'name' => 'manage-map',
            'description' => 'Manage Map',
            'main_menu'=>'map',
            'sub_menu'=> null,
            'main_link'=>'map',
            'sort' => 17,
            'icon' => 'fa fa-globe'
        ],
        PermissionSlug::HEAT_MAP => [
            'name' => 'heat-map',
            'description' => 'View Heat Map',
            'main_menu'=>'map',
            'sub_menu'=> 'heat_map',
            'sub_link'=>'map/heatmap',
            'sort' => 16.1,
            'icon' => 'fa fa-circle-thin'
        ],
          PermissionSlug::MAP_VIEW => [
            'name' => 'map-view',
            'description' => 'Map View',
            'main_menu'=>'map',
            'sub_menu'=> null,
            'main_link'=>'map',
            'sort' => 17,
            'icon' => 'fa fa-globe'
        ],
// cms
        PermissionSlug::CMS => [
            'name' => 'cms',
            'description' => 'Manage Cms',
            'main_menu'=>'cms',
            'sub_menu'=> null,
            'main_link'=>'cms',
            'sort' => 17,
            'icon' => 'fa fa-globe'
        ],

];

    /**
     * List of all the roles to be created along with their permissions.
     *
     * @var array
     */
    protected $roles = [
        RoleSlug::SUPER_ADMIN => [
            'name' => 'Super Admin',
            'description' => 'Admin group with unrestricted access',
            'all' => true,
        ],
        RoleSlug::USER => [
            'name' => 'Normal User',
            'description' => 'Normal user with standard access',
            'permissions' => []
        ],
        RoleSlug::ADMIN => [
            'name' => 'Admin',
            'description' => 'Admin group with restricted access',
            'permissions' => [
                // PermissionSlug::GET_ALL_ROLES,
            PermissionSlug::GET_ALL_PERMISSIONS,
            PermissionSlug::ACCESS_DASHBOARD,
            PermissionSlug::SETTINGS,
            PermissionSlug::VIEW_COMPANIES,
            PermissionSlug::DRIVERS_MENU,
            PermissionSlug::VIEW_DRIVERS,
            PermissionSlug::VIEW_TYPES,
            PermissionSlug::VIEW_ZONE,
            PermissionSlug::MAP_MENU,
            PermissionSlug::VIEW_SYSTEM_SETINGS,
            PermissionSlug::USER_MENU,
            PermissionSlug::VIEW_USERS,
            PermissionSlug::SERVICE_LOCATION,
            PermissionSlug::ADMIN,
            PermissionSlug::DISPATCH_REQUEST,
            PermissionSlug::LIST_AIRPORTS,
            PermissionSlug::ADD_AIRPORTS,
            PermissionSlug::EDIT_AIRPORTS,
            PermissionSlug::EDIT_ROLES,
            PermissionSlug::CMS,
            PermissionSlug::MAP_VIEW,
            PermissionSlug::MAP_VIEW_AIRPORTS,
            PermissionSlug::DELETE_AIRPORTS,
            PermissionSlug::MANAGE_MAP,
            PermissionSlug::HEAT_MAP,
            PermissionSlug::REPORTS,
            PermissionSlug::USER_REPORT,
            PermissionSlug::DRIVER_REPORT,
            PermissionSlug::FINANCE_REPORT,
            PermissionSlug::OWNER_REPORT,
            PermissionSlug::DRIVER_DUTIES_REPORT,
            PermissionSlug::COMPLAINT_TITLE,
            PermissionSlug::ADD_COMPLAINT_TITLE,
            PermissionSlug::EDIT_COMPLAINT_TITLE,
            PermissionSlug::DELETE_COMPLAINT_TITLE,
            PermissionSlug::TOGGLE_COMPLAINT_TITLE,
            PermissionSlug::COMPLAINTS,
            PermissionSlug::USER_COMPLAINT,
            PermissionSlug::DRIVER_COMPLAINT,
            PermissionSlug::OWNER_COMPLAINT,
            PermissionSlug::CANCELLATION_REASON,
            PermissionSlug::ADD_CANCELLATION ,
            PermissionSlug::EDIT_CANCELLATION,
            PermissionSlug::DELETE_CANCELLATION,
            PermissionSlug::TOGGLE_CANCELLATION,
            PermissionSlug::MANAGE_FAQ,
            PermissionSlug::ADD_FAQ,
            PermissionSlug::EDIT_FAQ,
            PermissionSlug::DELETE_FAQ,
            PermissionSlug::TOGGLE_FAQ,
            PermissionSlug::MANAGE_COUNTRY,
            PermissionSlug::ADD_COUNTRY,
            PermissionSlug::EDIT_COUNTRY,
            PermissionSlug::DELETE_COUNTRY,
            PermissionSlug::TOGGLE_COUNTRY,
            PermissionSlug::NOTIFICATIONS,
            PermissionSlug::VIEW_NOTIFICATIONS,
            PermissionSlug::SEND_PUSH,
            PermissionSlug::DELETE_NOTIFICATIONS,
            PermissionSlug::MANAGE_PROMO,
            PermissionSlug::ADD_PROMO,
            PermissionSlug::EDIT_PROMO,
            PermissionSlug::DELETE_PROMO,
            PermissionSlug::TOGGLE_PROMO,
            PermissionSlug::VIEW_SOS,
            PermissionSlug::ADD_SOS,
            PermissionSlug::EDIT_SOS,
            PermissionSlug::DELETE_SOS,
            PermissionSlug::TOGGLE_SOS,
            PermissionSlug::ADD_USER,
            PermissionSlug::EDIT_USER,
            PermissionSlug::DELETE_USER,
            PermissionSlug::TOGGLE_USER,
            PermissionSlug::VIEW_USER_REQUEST_LIST,
            PermissionSlug::USER_PAYMENT_HISTORY,
            PermissionSlug::FLEET_DRIVER_DOCUMENT,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_VIEW_IMAGE,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_EDIT,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_UPLOAD,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_TOGGLE,
            PermissionSlug::FLEET_DRIVERS_MENU,
            PermissionSlug::VIEW_APPROVED_FLEET_DRIVERS ,
            PermissionSlug::FLEET_DRIVERS_WAITING_FOR_APPROVAL,
            PermissionSlug::EDIT_FLEET_DRIVERS,
            PermissionSlug::TOGGLE_FLEET_DRIVERS,
            PermissionSlug::UPDATE_FLEET_DRIVERS,
            PermissionSlug::DELETE_FLEET_DRIVERS,
            PermissionSlug::ADD_FLEET_DRIVERS,
            PermissionSlug::VIEW_FLEET_DRIVER_REQUEST_LIST,
            PermissionSlug::FLEET_DRIVER_PAYMENT_HISTORY,
            PermissionSlug::VIEW_FLEET_DRIVER_PROFILE,
            PermissionSlug::NEGATIVE_BALACE_DRIVER_VIEW,
            PermissionSlug::DRIVER_WITHDRAWAL_REQUEST_VIEW,
            PermissionSlug::VIEW_DRIVER_RATING,
            PermissionSlug::DRIVER_DOCUMENT,
            PermissionSlug::DRIVER_DOCUMENT_VIEW_IMAGE ,
            PermissionSlug::DRIVER_DOCUMENT_EDIT,
            PermissionSlug::DRIVER_DOCUMENT_UPLOAD,
            PermissionSlug::DRIVER_DOCUMENT_TOGGLE,
            PermissionSlug::VIEW_PPROVAL_PENDING_DRIVERS,
            PermissionSlug::VIEW_DRIVER_RATINGS,
            PermissionSlug::VIEW_DRIVER_WITHDRAWAL_REQUESTS,
            PermissionSlug::VIEW_NEGATIVE_BALANCE_DRIVERS,
            PermissionSlug::EDIT_DRIVERS,
            PermissionSlug::TOGGLE_DRIVERS,
            PermissionSlug::VIEW_REQUEST_LIST,
            PermissionSlug::DRIVER_PAYMENT_HISTORY,
            PermissionSlug::VIEW_DRIVER_PROFILE,
            PermissionSlug::ADD_DRIVERS,
            PermissionSlug::UPDATE_DRIVERS,
            PermissionSlug::DELETE_DRIVERS,
            PermissionSlug::VEHICLE_FARE,
            PermissionSlug::VEHICLE_FARE,
            PermissionSlug::EDIT_PRICE,
            PermissionSlug::DELETE_PRICE,
            PermissionSlug::TOGGLE_PRICE,
            PermissionSlug::DEFAULT_VEHICLE_TYPE,
            PermissionSlug::ASSIGN_RENTAL_PACKAGE,
            PermissionSlug::RENTAL_PACKAGE,
            PermissionSlug::ADD_RENTAL_PACKAGE,
            PermissionSlug::EDIT_RENTAL_PACKAGE,
            PermissionSlug::DELETE_RENTAL_PACKAGE,
            PermissionSlug::TOGGLE_RENTAL_PACKAGE,
            PermissionSlug::VIEW_ZONE_MAP,
            PermissionSlug::ADD_ZONE,
            PermissionSlug::EDIT_ZONE,
            PermissionSlug::DELETE_ZONE,
            PermissionSlug::TOGGLE_ZONE,
            PermissionSlug::SURGE_ZONE,
            PermissionSlug::TOGGLE_AIRPORTS,
            PermissionSlug::ADD_TYPES,
            PermissionSlug::EDIT_TYPES,
            PermissionSlug::DELETE_TYPES,
            PermissionSlug::TOGGLE_TYPES,
            PermissionSlug::VIEW_REQUEST,
            PermissionSlug::RIDES,
            PermissionSlug::SCHEDULED_RIDES,
            PermissionSlug::CANCELLATION_RIDES,
            PermissionSlug::MANAGE_FLEET,
            PermissionSlug::CREATE_FLEET,
            PermissionSlug::EDIT_FLEET,
            PermissionSlug::DELETE_FLEET,
            PermissionSlug::FLEET_TOGGLE_STATUS,
            PermissionSlug::FLEET_APPROVE_STATUS,
            PermissionSlug::VIEW_FLEET_DOCUMENT,
            PermissionSlug::TOGGLE_FLEET_NEEEDED_DOC,
            PermissionSlug::MANAGE_OWNER_NEEDED_DOC,
            PermissionSlug::ADD_OWNER_NEEEDED_DOC,
            PermissionSlug::EDIT_OWNER_NEEEDED_DOC,
            PermissionSlug::DELETE_OWNER_NEEEDED_DOC,
            PermissionSlug::TOGGLE_OWNER_NEEEDED_DOC,
            PermissionSlug::PACKAGE_TYPE,
            PermissionSlug::ADD_PACKAGE_TYPE,
            PermissionSlug::EDIT_PACKAGE_TYPE,
            PermissionSlug::DELETE_PACKAGE_TYPE,
            PermissionSlug::TOGGLE_PACKAGE_TYPE,
            PermissionSlug::BANNER_IMAGE,
            PermissionSlug::ADD_BANNER_IMAGE,
            PermissionSlug::EDIT_BANNER_IMAGE,
            PermissionSlug::DELETE_BANNER_IMAGE,
            PermissionSlug::TOGGLE_BANNER_IMAGE,
            PermissionSlug::MANAGE_DRIVER_NEEDED_DOC,
            PermissionSlug::ADD_DRIVER_NEEEDED_DOC,
            PermissionSlug::EDIT_DRIVER_NEEEDED_DOC,
            PermissionSlug::DELETE_DRIVER_NEEEDED_DOC,
            PermissionSlug::TOGGLE_DRIVER_NEEEDED_DOC,
            PermissionSlug::MANAGE_FLEET_NEEDED_DOC,
            PermissionSlug::ADD_FLEET_NEEEDED_DOC,
            PermissionSlug::EDIT_FLEET_NEEEDED_DOC,
            PermissionSlug::DELETE_FLEET_NEEEDED_DOC,
            PermissionSlug::TOGGLE_FLEET_NEEEDED_DOC,
            PermissionSlug::GOODS_TYPES,
            PermissionSlug::ADD_GOODS_TYPES,
            PermissionSlug::EDIT_GOODS_TYPES,
            PermissionSlug::DELETE_GOODS_TYPES,
            PermissionSlug::TOGGLE_GOODS_TYPES,
            PermissionSlug::ADD_SERVICE_LOCATION,
            PermissionSlug::EDIT_SERVICE_LOCATION,
            PermissionSlug::DELETE_SERVICE_LOCATION,
            PermissionSlug::TOGGLE_SERVICE_LOCATION,
            PermissionSlug::MANAGE_OWNER,
            PermissionSlug::CREATE_OWNER,
            PermissionSlug::EDIT_OWNER,
            PermissionSlug::DELETE_OWNER,
            PermissionSlug::TOGGLE_OWNER_STATUS,
            PermissionSlug::VIEW_OWNER_DOCUMENT,
            PermissionSlug::ADD_PRICE,
        ],
        ],

        RoleSlug::SUB_ADMIN => [
            'name' => 'Sub Admin',
            'description' => 'Sub Admin group with restricted access',
            'permissions' => [
                // PermissionSlug::GET_ALL_ROLES,
            PermissionSlug::ACCESS_DASHBOARD,
            PermissionSlug::SETTINGS,
            PermissionSlug::VIEW_COMPANIES,
            PermissionSlug::DRIVERS_MENU,
            PermissionSlug::VIEW_DRIVERS,
            PermissionSlug::VIEW_TYPES,
            PermissionSlug::VIEW_ZONE,
            PermissionSlug::MAP_MENU,
            PermissionSlug::VIEW_SYSTEM_SETINGS,
            PermissionSlug::USER_MENU,
            PermissionSlug::VIEW_USERS,
            PermissionSlug::SERVICE_LOCATION,
            PermissionSlug::EDIT_SERVICE_LOCATION,
            PermissionSlug::TOGGLE_SERVICE_LOCATION,
            PermissionSlug::ADMIN,
            PermissionSlug::MASTER,
            PermissionSlug::LIST_AIRPORTS,
            PermissionSlug::ADD_AIRPORTS,
            PermissionSlug::EDIT_AIRPORTS,
            PermissionSlug::CMS,
            PermissionSlug::MAP_VIEW,
            PermissionSlug::MAP_VIEW_AIRPORTS,
            PermissionSlug::MANAGE_MAP,
            PermissionSlug::HEAT_MAP,
            PermissionSlug::REPORTS,
            PermissionSlug::USER_REPORT,
            PermissionSlug::DRIVER_REPORT,
            PermissionSlug::FINANCE_REPORT,
            PermissionSlug::OWNER_REPORT,
            PermissionSlug::DRIVER_DUTIES_REPORT,
            PermissionSlug::COMPLAINT_TITLE,
            PermissionSlug::EDIT_COMPLAINT_TITLE,
            PermissionSlug::TOGGLE_COMPLAINT_TITLE,
            PermissionSlug::COMPLAINTS,
            PermissionSlug::USER_COMPLAINT,
            PermissionSlug::DRIVER_COMPLAINT,
            PermissionSlug::OWNER_COMPLAINT,
            PermissionSlug::CANCELLATION_REASON,
            PermissionSlug::EDIT_CANCELLATION,
            PermissionSlug::TOGGLE_CANCELLATION,
            PermissionSlug::MANAGE_FAQ,
            PermissionSlug::EDIT_FAQ,
            PermissionSlug::TOGGLE_FAQ,
            PermissionSlug::NOTIFICATIONS,
            PermissionSlug::VIEW_NOTIFICATIONS,
            PermissionSlug::SEND_PUSH,
            PermissionSlug::MANAGE_PROMO,
            PermissionSlug::EDIT_PROMO,
            PermissionSlug::TOGGLE_PROMO,
            PermissionSlug::VIEW_SOS,
            PermissionSlug::TOGGLE_SOS,
            PermissionSlug::ADD_USER,
            PermissionSlug::EDIT_USER,
            PermissionSlug::TOGGLE_USER,
            PermissionSlug::VIEW_USER_REQUEST_LIST,
            PermissionSlug::USER_PAYMENT_HISTORY,
            PermissionSlug::FLEET_DRIVER_DOCUMENT,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_VIEW_IMAGE,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_EDIT,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_UPLOAD,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_TOGGLE,
            PermissionSlug::FLEET_DRIVERS_MENU,
            PermissionSlug::VIEW_APPROVED_FLEET_DRIVERS ,
            PermissionSlug::FLEET_DRIVERS_WAITING_FOR_APPROVAL,
            PermissionSlug::EDIT_FLEET_DRIVERS,
            PermissionSlug::TOGGLE_FLEET_DRIVERS,
            PermissionSlug::UPDATE_FLEET_DRIVERS,
            PermissionSlug::ADD_FLEET_DRIVERS,
            PermissionSlug::VIEW_FLEET_DRIVER_REQUEST_LIST,
            PermissionSlug::FLEET_DRIVER_PAYMENT_HISTORY,
            PermissionSlug::VIEW_FLEET_DRIVER_PROFILE,
            PermissionSlug::NEGATIVE_BALACE_DRIVER_VIEW,
            PermissionSlug::DRIVER_WITHDRAWAL_REQUEST_VIEW,
            PermissionSlug::VIEW_DRIVER_RATING,
            PermissionSlug::DRIVER_DOCUMENT,
            PermissionSlug::DRIVER_DOCUMENT_VIEW_IMAGE ,
            PermissionSlug::DRIVER_DOCUMENT_EDIT,
            PermissionSlug::DRIVER_DOCUMENT_UPLOAD,
            PermissionSlug::DRIVER_DOCUMENT_TOGGLE,
            PermissionSlug::VIEW_PPROVAL_PENDING_DRIVERS,
            PermissionSlug::VIEW_DRIVER_RATINGS,
            PermissionSlug::VIEW_DRIVER_WITHDRAWAL_REQUESTS,
            PermissionSlug::VIEW_NEGATIVE_BALANCE_DRIVERS,
            PermissionSlug::EDIT_DRIVERS,
            PermissionSlug::TOGGLE_DRIVERS,
            PermissionSlug::VIEW_REQUEST_LIST,
            PermissionSlug::DRIVER_PAYMENT_HISTORY,
            PermissionSlug::VIEW_DRIVER_PROFILE,
            PermissionSlug::ADD_DRIVERS,
            PermissionSlug::UPDATE_DRIVERS,
            PermissionSlug::VEHICLE_FARE,
            PermissionSlug::VEHICLE_FARE,
            PermissionSlug::EDIT_PRICE,
            PermissionSlug::TOGGLE_PRICE,
            PermissionSlug::DEFAULT_VEHICLE_TYPE,
            PermissionSlug::ASSIGN_RENTAL_PACKAGE,
            PermissionSlug::RENTAL_PACKAGE,
            PermissionSlug::EDIT_RENTAL_PACKAGE,
            PermissionSlug::TOGGLE_RENTAL_PACKAGE,
            PermissionSlug::VIEW_ZONE_MAP,
            PermissionSlug::EDIT_ZONE,
            PermissionSlug::TOGGLE_ZONE,
            PermissionSlug::SURGE_ZONE,
            PermissionSlug::TOGGLE_AIRPORTS,
            PermissionSlug::EDIT_TYPES,
            PermissionSlug::TOGGLE_TYPES,
            PermissionSlug::VIEW_REQUEST,
            PermissionSlug::RIDES,
            PermissionSlug::SCHEDULED_RIDES,
            PermissionSlug::CANCELLATION_RIDES,
            PermissionSlug::MANAGE_FLEET,
            PermissionSlug::CREATE_FLEET,
            PermissionSlug::EDIT_FLEET,
            PermissionSlug::FLEET_TOGGLE_STATUS,
            PermissionSlug::FLEET_APPROVE_STATUS,
            PermissionSlug::VIEW_FLEET_DOCUMENT,
            PermissionSlug::BANNER_IMAGE,
            PermissionSlug::GOODS_TYPES,
            PermissionSlug::EDIT_GOODS_TYPES,
            PermissionSlug::TOGGLE_GOODS_TYPES,
            PermissionSlug::MANAGE_OWNER,
            PermissionSlug::CREATE_OWNER,
            PermissionSlug::EDIT_OWNER,
            PermissionSlug::TOGGLE_OWNER_STATUS,
            PermissionSlug::VIEW_OWNER_DOCUMENT,
            PermissionSlug::ADD_PRICE,
        ],
        ],
        RoleSlug::MANAGER => [
            'name' => 'Manager',
            'description' => 'Manager group with Highly restricted access',
            'permissions' => [
            PermissionSlug::ACCESS_DASHBOARD,
            PermissionSlug::SETTINGS,
            PermissionSlug::VIEW_COMPANIES,
            PermissionSlug::DRIVERS_MENU,
            PermissionSlug::VIEW_DRIVERS,
            PermissionSlug::VIEW_TYPES,
            PermissionSlug::VIEW_ZONE,
            PermissionSlug::MAP_MENU,
            PermissionSlug::VIEW_SYSTEM_SETINGS,
            PermissionSlug::USER_MENU,
            PermissionSlug::VIEW_USERS,
            PermissionSlug::SERVICE_LOCATION,
            PermissionSlug::ADMIN,
            PermissionSlug::LIST_AIRPORTS,
            PermissionSlug::MAP_VIEW,
            PermissionSlug::MAP_VIEW_AIRPORTS,
            PermissionSlug::MANAGE_MAP,
            PermissionSlug::HEAT_MAP,
            PermissionSlug::REPORTS,
            PermissionSlug::USER_REPORT,
            PermissionSlug::DRIVER_REPORT,
            PermissionSlug::FINANCE_REPORT,
            PermissionSlug::OWNER_REPORT,
            PermissionSlug::DRIVER_DUTIES_REPORT,
            PermissionSlug::COMPLAINT_TITLE,
            PermissionSlug::COMPLAINTS,
            PermissionSlug::USER_COMPLAINT,
            PermissionSlug::DRIVER_COMPLAINT,
            PermissionSlug::OWNER_COMPLAINT,
            PermissionSlug::MANAGE_FLEET,
            PermissionSlug::CREATE_FLEET,
            PermissionSlug::EDIT_FLEET,
            PermissionSlug::DELETE_FLEET,
            PermissionSlug::CANCELLATION_REASON,
            PermissionSlug::MANAGE_FAQ,
            PermissionSlug::NOTIFICATIONS,
            PermissionSlug::VIEW_NOTIFICATIONS,
            PermissionSlug::SEND_PUSH,
            PermissionSlug::DELETE_NOTIFICATIONS,
            PermissionSlug::MANAGE_PROMO,
            PermissionSlug::VIEW_SOS,
            PermissionSlug::ADD_USER,
            PermissionSlug::EDIT_USER,
            PermissionSlug::DELETE_USER,
            PermissionSlug::TOGGLE_USER,
            PermissionSlug::VIEW_USER_REQUEST_LIST,
            PermissionSlug::USER_PAYMENT_HISTORY,
            PermissionSlug::FLEET_DRIVER_DOCUMENT,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_VIEW_IMAGE,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_EDIT,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_UPLOAD,
            PermissionSlug::FLEET_DRIVER_DOCUMENT_TOGGLE,
            PermissionSlug::FLEET_DRIVERS_MENU,
            PermissionSlug::VIEW_APPROVED_FLEET_DRIVERS ,
            PermissionSlug::FLEET_DRIVERS_WAITING_FOR_APPROVAL,
            PermissionSlug::EDIT_FLEET_DRIVERS,
            PermissionSlug::TOGGLE_FLEET_DRIVERS,
            PermissionSlug::UPDATE_FLEET_DRIVERS,
            PermissionSlug::DELETE_FLEET_DRIVERS,
            PermissionSlug::ADD_FLEET_DRIVERS,
            PermissionSlug::VIEW_FLEET_DRIVER_REQUEST_LIST,
            PermissionSlug::FLEET_DRIVER_PAYMENT_HISTORY,
            PermissionSlug::VIEW_FLEET_DRIVER_PROFILE,
            PermissionSlug::NEGATIVE_BALACE_DRIVER_VIEW,
            PermissionSlug::DRIVER_WITHDRAWAL_REQUEST_VIEW,
            PermissionSlug::VIEW_DRIVER_RATING,
            PermissionSlug::DRIVER_DOCUMENT,
            PermissionSlug::DRIVER_DOCUMENT_VIEW_IMAGE ,
            PermissionSlug::DRIVER_DOCUMENT_EDIT,
            PermissionSlug::DRIVER_DOCUMENT_UPLOAD,
            PermissionSlug::DRIVER_DOCUMENT_TOGGLE,
            PermissionSlug::VIEW_PPROVAL_PENDING_DRIVERS,
            PermissionSlug::VIEW_DRIVER_RATINGS,
            PermissionSlug::VIEW_DRIVER_WITHDRAWAL_REQUESTS,
            PermissionSlug::VIEW_NEGATIVE_BALANCE_DRIVERS,
            PermissionSlug::EDIT_DRIVERS,
            PermissionSlug::TOGGLE_DRIVERS,
            PermissionSlug::VIEW_REQUEST_LIST,
            PermissionSlug::DRIVER_PAYMENT_HISTORY,
            PermissionSlug::VIEW_DRIVER_PROFILE,
            PermissionSlug::ADD_DRIVERS,
            PermissionSlug::UPDATE_DRIVERS,
            PermissionSlug::DELETE_DRIVERS,
            PermissionSlug::VIEW_ZONE_MAP,
            PermissionSlug::MANAGE_OWNER,
            PermissionSlug::CREATE_OWNER,
            PermissionSlug::EDIT_OWNER,
            PermissionSlug::DELETE_OWNER,
            PermissionSlug::TOGGLE_OWNER_STATUS,
            PermissionSlug::VIEW_OWNER_DOCUMENT,
        ],
        ],
         RoleSlug::OWNER=>[
            'name' => 'Owner',
            'description' => 'Owner for company management',
            'permissions' => [
                 PermissionSlug::ACCESS_DASHBOARD,PermissionSlug::MANAGE_FLEET,PermissionSlug::CREATE_FLEET,PermissionSlug::EDIT_FLEET,PermissionSlug::DELETE_FLEET,PermissionSlug::FLEET_TOGGLE_STATUS,PermissionSlug::MANAGE_CARMODEL,
                     PermissionSlug::DRIVERS_MENU,PermissionSlug::VIEW_DRIVERS
            ],
        ],
        RoleSlug::DRIVER=>[
            'name' => 'Driver',
            'description' => 'Driver user with standard access',
            'permissions' => [],
        ],
        RoleSlug::DISPATCHER=>[
            'name' => 'Dispatcher',
            'description' => 'Dispatcher user with standard access',
            'permissions' => [],
        ],
        // RoleSlug::DELIVERY_DISPATCHER=>[
        //     'name' => 'Delivery-Dispatcher',
        //     'description' => 'Delivery Dispatcher user with standard access',
        //     'permissions' => [],
        // ],



    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach ($this->permissions as $permissionSlug => $attributes) {
                // Create permission if it doesn't exist
                Permission::firstOrCreate(['slug' => $permissionSlug], $attributes);
            }

            foreach ($this->roles as $roleSlug => $role) {
                // Create role if it doesn't exist
                $createdRole = Role::firstOrCreate(
                    ['slug' => $roleSlug],
                    array_merge(array_except($role, ['permissions']), ['locked' => true])
                );

                // Sync permissions
                if (isset($role['permissions'])) {
                    $rolePermissions = $role['permissions'];
                    $rolePermissionIds = Permission::whereIn('slug', $rolePermissions)->pluck('id');
                    $createdRole->permissions()->sync($rolePermissionIds);
                }
            }

            /**
             * Delete all unused permissions
             */
            $existingPermissions = Permission::pluck('slug')->toArray();

            $newPermissions = array_keys($this->permissions);

            $permissionsToDelete = array_diff($existingPermissions, $newPermissions);

            Permission::whereIn('slug', $permissionsToDelete)->delete();
        });
    }
}
