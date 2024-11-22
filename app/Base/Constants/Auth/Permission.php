<?php

namespace App\Base\Constants\Auth;

class Permission
{
/* Dashboard and Settings*/
    const ACCESS_DASHBOARD = 'access-dashboard';
    const SETTINGS = 'view-settings';
    const GET_ALL_ROLES = 'get-all-roles';
    const VIEW_ROLES = 'view-roles';
    const EDIT_ROLES = 'edit-roles';
    const VIEW_SYSTEM_SETINGS = 'view-system-settings';
    const CREATE_ROLES = 'create-roles';
    const CREATE_NEW_ROLE = 'create-new-roles';
    const ASSIGN_PERMISSIONS = 'assign-permissions';
    const GET_ALL_PERMISSIONS = 'get-all-permissions';
    const VIEW_TRANSLATIONS = 'view-translations';
    //Country
       const MANAGE_COUNTRY = 'manage-country';
       const DELETE_COUNTRY = 'delete-country';
       const EDIT_COUNTRY = 'edit-country';
       const ADD_COUNTRY = 'add-country';
       const TOGGLE_COUNTRY = 'toggle-country';
/* Master Data */
    const MASTER = 'master-data';
    // car Make
    const MANAGE_CARMAKE = 'manage-carmake';
    const ADD_CARMAKE = 'add-carmake';
    const EDIT_CARMAKE = 'edit-carmake';
    const DELETE_CARMAKE = 'delete-carmake';
    const TOGGLE_CARMAKE = 'toggle-carmake';
    // car Model
    const MANAGE_CARMODEL = 'manage-carmodel';
    const ADD_CARMODEL = 'add-carmodel';
    const EDIT_CARMODEL = 'edit-carmodel';
    const DELETE_CARMODEL = 'delete-carmodel';
    const TOGGLE_CARMODEL = 'toggle-carmodel';

    // Manage Driver Needed Doc
    const MANAGE_DRIVER_NEEDED_DOC = 'manage-driver-needed-document';
    const ADD_DRIVER_NEEEDED_DOC = 'add-driver-needed-document';
    const EDIT_DRIVER_NEEEDED_DOC = 'edit-driver-needed-document';
    const DELETE_DRIVER_NEEEDED_DOC = 'delete-driver-needed-document';
    const TOGGLE_DRIVER_NEEEDED_DOC = 'toggle-driver-needed-document';

    // Manage Fleet Needed Doc
    const MANAGE_FLEET_NEEDED_DOC = 'manage-fleet-needed-document';
    const ADD_FLEET_NEEEDED_DOC = 'add-fleet-needed-document';
    const EDIT_FLEET_NEEEDED_DOC = 'edit-fleet-needed-document';
    const DELETE_FLEET_NEEEDED_DOC = 'delete-fleet-needed-document';
    const TOGGLE_FLEET_NEEEDED_DOC = 'toggle-fleet-needed-document';
    
    // Manage Owner Needed Doc
    const MANAGE_OWNER_NEEDED_DOC = 'manage-owner-needed-document';
    const ADD_OWNER_NEEEDED_DOC = 'add-owner-needed-document';
    const EDIT_OWNER_NEEEDED_DOC = 'edit-owner-needed-document';
    const DELETE_OWNER_NEEEDED_DOC = 'delete-owner-needed-document';
    const TOGGLE_OWNER_NEEEDED_DOC = 'toggle-owner-needed-document';
    // Manage Package Type
    const PACKAGE_TYPE = 'package-type';
    const ADD_PACKAGE_TYPE = 'add-package-type';
    const EDIT_PACKAGE_TYPE = 'edit-package-type';
    const DELETE_PACKAGE_TYPE = 'delete-package-type';
    const TOGGLE_PACKAGE_TYPE = 'toggle-package-type'; 
    // Manage Banner Image
    const BANNER_IMAGE = 'banner-image';
    const ADD_BANNER_IMAGE = 'add-banner-image';
    const EDIT_BANNER_IMAGE = 'edit-banner-image';
    const DELETE_BANNER_IMAGE = 'delete-banner-image';
    const TOGGLE_BANNER_IMAGE = 'toggle-banner-image'; 
  
    // Manage Goods Type
    const GOODS_TYPES = 'manage-goods-types';
    const ADD_GOODS_TYPES = 'add-goods-types';
    const EDIT_GOODS_TYPES = 'edit-goods-types';
    const DELETE_GOODS_TYPES = 'delete-goods-types';
    const TOGGLE_GOODS_TYPES = 'toggle-goods-types'; 

/* Service-Location */
    const SERVICE_LOCATION = 'service_location';
    const ADD_SERVICE_LOCATION = 'Add_Service_Location';
    const EDIT_SERVICE_LOCATION = 'Edit_Service_Location';
    const DELETE_SERVICE_LOCATION = 'Delete_Service_Location';
    const TOGGLE_SERVICE_LOCATION = 'Toggle_Service_Location'; 

/* Manage Owner */ 
    const MANAGE_OWNER = 'manage-owner';
    const CREATE_OWNER = 'add-owner';
    const EDIT_OWNER = 'edit-owner';
    const DELETE_OWNER = 'delete-owner';
    const TOGGLE_OWNER_STATUS = 'toggle-owner-status';
    const VIEW_OWNER_DOCUMENT = 'view-owner-document';
    const OWNER_PAYMENT_HISTORY = 'owner-payment-history';

 /* Manage Fleets */ 
    const MANAGE_FLEET = 'manage-fleet';
    const CREATE_FLEET = 'add-fleet';
    const EDIT_FLEET = 'edit-fleet';
    const DELETE_FLEET = 'delete-fleet';
    const FLEET_TOGGLE_STATUS = 'toggle-fleet-status';
    const FLEET_APPROVE_STATUS = 'toggle-fleet-approval';  
    const VIEW_FLEET_DOCUMENT = 'view-fleet-document';  

/* Admin  */
   const ADMIN = 'admin';
   const CREATE_ADMIN = 'add-admin';
   const EDIT_ADMIN = 'edit-admin';
   const DELETE_ADMIN = 'delete-admin';
   const TOGGLE_ADMIN = 'toggle-admin-status';  
/* Requests */
   const VIEW_REQUEST = 'view-requests';
   const RIDES = 'view-rides';
   const SCHEDULED_RIDES = 'scheduled-rides';
   const CANCELLATION_RIDES = 'cancellation-rides';

/* Vehicle Types */
   const VIEW_TYPES = 'view-types';
   const ADD_TYPES = 'add-vehicle-types';
   const EDIT_TYPES = 'edit-vehicle-types';
   const DELETE_TYPES = 'delete-vehicle-types';
   const TOGGLE_TYPES = 'toggle-vehicle-types';
/* Zone */
    const MAP_MENU = 'map-menu';
    const VIEW_ZONE = 'view-zone';
    const VIEW_ZONE_MAP = 'view-zone-map';
    const ADD_ZONE = 'add-zone';
    const EDIT_ZONE = 'edit-zone';
    const DELETE_ZONE = 'delete-zone';
    const TOGGLE_ZONE = 'toggle-zone';
    const SURGE_ZONE = 'surge-zone';
    
    // Ariport Slugs
    const LIST_AIRPORTS = 'list-airports';
    const ADD_AIRPORTS = 'Add-Airports';
    const EDIT_AIRPORTS = 'Edit-airports';
    const DELETE_AIRPORTS = 'Delete-Airports';
    const MAP_VIEW_AIRPORTS = 'Map-view-Airports';
    const TOGGLE_AIRPORTS = 'Toggle-Airports';
/* Vehicle Fare */
    const VEHICLE_FARE = 'vehicle-fare';
    const ADD_PRICE = 'add-price';
    const EDIT_PRICE= 'edit-price';
    const DELETE_PRICE = 'delete-price';
    const TOGGLE_PRICE = 'toggle-price';
    const DEFAULT_VEHICLE_TYPE = 'default-vehicle-type';
    const ASSIGN_RENTAL_PACKAGE = 'assign-rental-package';
    const RENTAL_PACKAGE = 'rental-package';
    const ADD_RENTAL_PACKAGE = 'add-rental-package';
    const EDIT_RENTAL_PACKAGE = 'edit-rental-package';
    const DELETE_RENTAL_PACKAGE = 'delete-rental-package';
    const TOGGLE_RENTAL_PACKAGE = 'toggle-rental-package';
/* Drivers */
    const DRIVERS_MENU = 'drivers-menu';
    const VIEW_DRIVERS = 'view-drivers';
    const VIEW_PPROVAL_PENDING_DRIVERS = 'view-approval-pending-drivers';
    const VIEW_DRIVER_RATINGS = 'view-driver-ratings';
    CONST VIEW_DRIVER_WITHDRAWAL_REQUESTS = 'view-driver-withdrawal-requests';
    const VIEW_NEGATIVE_BALANCE_DRIVERS = 'view-negative-balance-drivers';
    const EDIT_DRIVERS = 'edit-drivers';
    const TOGGLE_DRIVERS = 'toggle-drivers';
    const VIEW_REQUEST_LIST = 'view-request-list';
    const DRIVER_PAYMENT_HISTORY = 'driver-payment-history';
    const VIEW_DRIVER_PROFILE = 'view-driver-profile';
    const ADD_DRIVERS = 'add-drivers';
    const UPDATE_DRIVERS = 'update-drivers';
    const DELETE_DRIVERS = 'delete-drivers';
  /* Driver Document & Withdrawal Request &negative balance & rating */
    const DRIVER_DOCUMENT = 'driver-document';
    const DRIVER_DOCUMENT_VIEW = 'driver-document-view';
    const DRIVER_DOCUMENT_EDIT = 'driver-document-edit';
    const DRIVER_DOCUMENT_UPLOAD = 'driver-document-upload';
    const DRIVER_DOCUMENT_TOGGLE = 'driver-document-toggle';
    const DRIVER_DOCUMENT_VIEW_IMAGE = 'driver-document-view-image';
    const VIEW_DRIVER_RATING = 'view-driver-rating';
    const DRIVER_WITHDRAWAL_REQUEST_VIEW = 'driver-withdrwal-request-view';
    const NEGATIVE_BALACE_DRIVER_VIEW = 'neagtive-driver-view';
/* Fleet Drivers */
    const FLEET_DRIVERS_MENU = 'fleet-drivers-menu';
    const VIEW_APPROVED_FLEET_DRIVERS = 'view-approved-fleet-drivers';
    const FLEET_DRIVERS_WAITING_FOR_APPROVAL = 'fleet-drivers-waiting-for-approval';
    const EDIT_FLEET_DRIVERS ='edit-fleet-drivers';
    const TOGGLE_FLEET_DRIVERS = 'toggle-fleet-drivers';
    const DELETE_FLEET_DRIVERS = 'delete-fleet-drivers';
    const ADD_FLEET_DRIVERS = 'add-fleet-drivers';
    const VIEW_FLEET_DRIVER_REQUEST_LIST = 'view-fleet-driver-request-list';
    const FLEET_DRIVER_PAYMENT_HISTORY = 'fleet-driver-payment-history';
    const VIEW_FLEET_DRIVER_PROFILE = 'view-fleet-driver-profile';
    const UPDATE_FLEET_DRIVERS = 'update-fleet-drivers';
/* Fleet Drivers Document*/
    const FLEET_DRIVER_DOCUMENT = 'fleet-driver-document';
    const FLEET_DRIVER_DOCUMENT_VIEW = 'fleet-driver-document-view';
    const FLEET_DRIVER_DOCUMENT_EDIT = 'fleet-driver-document-edit';
    const FLEET_DRIVER_DOCUMENT_UPLOAD = 'fleet-driver-document-upload';
    const FLEET_DRIVER_DOCUMENT_TOGGLE = 'fleet-driver-document-toggle';
    const FLEET_DRIVER_DOCUMENT_VIEW_IMAGE = 'fleet-driver-document-view-image';

/* Users */
    const USER_MENU = 'user-menu';
    const VIEW_USERS = 'view-users';
    const DELETE_USER = 'delete-user';
    const EDIT_USER = 'edit-user';
    const ADD_USER = 'add-user';
    const TOGGLE_USER = 'toggle-user';
    const VIEW_USER_REQUEST_LIST = 'view-user-request-list';
    const USER_PAYMENT_HISTORY = 'user-payment-history';
    const VIEW_DELETED_USERS = 'view-delete-users';
/* SOS */
    const VIEW_SOS = 'view-sos';
    const DELETE_SOS = 'delete-sos';
    const EDIT_SOS = 'edit-sos';
    const ADD_SOS = 'add-sos';
    const TOGGLE_SOS = 'toggle-sos';

 //* Promo code */
    const MANAGE_PROMO = 'manage-promo';
    const ADD_PROMO = 'add-promo';
    const EDIT_PROMO = 'edit-promo';
    const TOGGLE_PROMO = 'toggle-promo';
    const DELETE_PROMO = 'delete-promo';
//Notifications
    const NOTIFICATIONS = 'notifications';
    const VIEW_NOTIFICATIONS = 'view-notifications';
    const SEND_PUSH ='send_push';
    const DELETE_NOTIFICATIONS = 'delete-notifications';
 //FAQ
    const MANAGE_FAQ = 'manage-faq';
    const VIEW_FAQ = 'view-faq';
    const DELETE_FAQ = 'delete-faq';
    const EDIT_FAQ = 'edit-faq';
    const ADD_FAQ = 'add-faq';
    const TOGGLE_FAQ = 'toggle-faq';
 //cancelation
    const CANCELLATION_REASON = 'cancellation-reason';
    const VIEW_CANCELLATION = 'view-cancellation';
    const DELETE_CANCELLATION = 'delete-cancellation';
    const EDIT_CANCELLATION = 'edit-cancellation';
    const ADD_CANCELLATION = 'add-cancellation';
    const TOGGLE_CANCELLATION = 'toggle-cancellation';
//Complaint
    const COMPLAINTS = 'complaints';
    const USER_COMPLAINT = 'user-complaint';
    const DRIVER_COMPLAINT = 'driver-complaint';
    const OWNER_COMPLAINT = 'owner-complaint';
    const OWNER_REPORT = 'owner-report';
/*complaint titile */
    const COMPLAINT_TITLE = 'complaint-title';
    const ADD_COMPLAINT_TITLE = 'add-complaint-title';
    const EDIT_COMPLAINT_TITLE = 'edit-complaint-title';
    const TOGGLE_COMPLAINT_TITLE = 'toggle-complaint-title';
    const DELETE_COMPLAINT_TITLE = 'delete-complaint-title';
/*Reports*/
    const REPORTS = 'reports';
    const USER_REPORT = 'user-report';
    const DRIVER_REPORT = 'driver-report';
    const FINANCE_REPORT = 'finance-report';
    const DRIVER_DUTIES_REPORT = 'driver-duties-report';

/*geo-fencing*/
    const MANAGE_MAP = 'manage-map';
    const HEAT_MAP = 'heat-map';
    const MAP_VIEW = 'map-view';
/*cms*/
    const CMS = 'cms';


    // Company permissions
    const VIEW_COMPANIES ='view-companies';
    const ADD_COMPANY = 'add-company';
    const UPDATE_COMPANY = 'update-company';
    const DELETE_COMPANY = 'delete-company';

    const USER_SOS = 'view-sos';
    const DISPATCH_REQUEST = 'dispatch-request';

}
