<?php
/**
 * @SWG\SecurityScheme(
 *   securityDefinition="Authorization",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization"
 * )
 */
/**
 * @SWG\SecurityScheme(
 *   securityDefinition="oddsol_auth",
 *   type="oauth2",
 *   authorizationUrl="http://localhost:2222/Base/public/api/v1/admin/login",
 *   flow="implicit",
 *   scopes={
 *     "read:oddsol": "read your oddsol",
 *     "write:oddsol": "modify oddsol in your account"
 *   }
 * )
 */
