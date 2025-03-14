<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zinwa Water Meter Utility API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            padding-top: 20px;
        }
        .container {
            max-width: 1200px;
        }
        h1 {
            color: #0066cc;
            margin-bottom: 30px;
        }
        h2 {
            color: #0066cc;
            margin-top: 40px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        h3 {
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        h4 {
            color: #555;
            margin-top: 25px;
        }
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
        }
        code {
            color: #d63384;
        }
        .endpoint {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .method {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }
        .get {
            background-color: #28a745;
        }
        .post {
            background-color: #007bff;
        }
        .put {
            background-color: #fd7e14;
        }
        .delete {
            background-color: #dc3545;
        }
        .url {
            font-family: monospace;
            margin-left: 10px;
        }
        .params-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .params-table th {
            background-color: #f1f1f1;
        }
        .nav-pills .nav-link.active {
            background-color: #0066cc;
        }
        .nav-pills .nav-link {
            color: #0066cc;
        }
        .tab-content {
            padding-top: 20px;
        }
        .authentication-note {
            background-color: #fff3cd;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Zinwa Water Meter Utility API Documentation</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top pt-3">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#introduction">Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#authentication">Authentication</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#users">Users & Authentication</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#meters">Meters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tokens">Tokens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#payments">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tariffs">Tariffs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#notifications">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#errors">Error Handling</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div id="introduction">
                <h2>Introduction</h2>
                <p>
                    Welcome to the Zinwa Water Meter Utility API documentation. This API allows you to interact with the Zinwa water meter system,
                    manage users, meters, tokens, payments, and more.
                </p>
                <h3>Base URL</h3>
                <p>All API requests should be made to:</p>
                <pre><code>https://api.zinwa.com/api</code></pre>

                <h3>Content Type</h3>
                <p>All requests and responses use JSON format. Ensure your requests include the header:</p>
                <pre><code>Content-Type: application/json
Accept: application/json</code></pre>
            </div>

            <div id="authentication">
                <h2>Authentication</h2>
                <p>
                    The API uses Laravel Sanctum for authentication. After logging in, you'll receive a token that should be included in the
                    Authorization header for all authenticated requests.
                </p>

                <h3>Authentication Header</h3>
                <pre><code>Authorization: Bearer {your_token}</code></pre>

                <div class="authentication-note">
                    <strong>Note:</strong> Most endpoints require authentication. Public endpoints will be marked as such.
                </div>
            </div>

            <div id="users">
                <h2>Users & Authentication</h2>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/register</span>
                    <p>Register a new user account.</p>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>name</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Full name of the user</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Email address (must be unique)</td>
                        </tr>
                        <tr>
                            <td>phone</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Phone number (must be unique if provided)</td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Password (min 8 characters)</td>
                        </tr>
                        <tr>
                            <td>password_confirmation</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Confirm password</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "password": "password123",
    "password_confirmation": "password123"
}</code></pre>

                    <h4>Example Response (201 Created)</h4>
                    <pre><code>{
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "role": "consumer",
        "status": "active",
        "email_verified": false,
        "phone_verified": false,
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T12:00:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/login</span>
                    <p>Authenticate a user and get an access token.</p>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>email</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Email address</td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Password</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "email": "john@example.com",
    "password": "password123"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "role": "consumer",
        "status": "active",
        "email_verified": false,
        "phone_verified": false,
        "last_login_at": "2023-05-20T12:30:00.000000Z",
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T12:30:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/logout</span>
                    <p>Revoke the current access token.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Successfully logged out"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/user</span>
                    <p>Get the authenticated user's details.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "role": "consumer",
    "status": "active",
    "email_verified": true,
    "phone_verified": false,
    "last_login_at": "2023-05-20T12:30:00.000000Z",
    "created_at": "2023-05-20T12:00:00.000000Z",
    "updated_at": "2023-05-20T12:30:00.000000Z"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/email/verify/{id}/{hash}</span>
                    <p>Verify a user's email address.</p>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Email verified successfully"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/phone/verification</span>
                    <p>Send a verification code to the user's phone.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>phone</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Phone number to verify</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "phone": "+1234567890"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Verification code sent to your phone"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/phone/verify</span>
                    <p>Verify a phone number with the provided code.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>code</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Verification code received via SMS</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "code": "123456"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Phone verified successfully"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/profile</span>
                    <p>Get the authenticated user's profile.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "role": "consumer",
    "status": "active",
    "email_verified": true,
    "phone_verified": true,
    "last_login_at": "2023-05-20T12:30:00.000000Z",
    "created_at": "2023-05-20T12:00:00.000000Z",
    "updated_at": "2023-05-20T12:30:00.000000Z"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method put">PUT</span>
                    <span class="url">/profile</span>
                    <p>Update the authenticated user's profile.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>name</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Full name of the user</td>
                        </tr>
                        <tr>
                            <td>email</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Email address (must be unique)</td>
                        </tr>
                        <tr>
                            <td>phone</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Phone number (must be unique if provided)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "name": "John Smith",
    "phone": "+1987654321"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Profile updated successfully",
    "user": {
        "id": 1,
        "name": "John Smith",
        "email": "john@example.com",
        "phone": "+1987654321",
        "role": "consumer",
        "status": "active",
        "email_verified": true,
        "phone_verified": false,
        "last_login_at": "2023-05-20T12:30:00.000000Z",
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T13:00:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/password</span>
                    <p>Change the authenticated user's password.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>current_password</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Current password</td>
                        </tr>
                        <tr>
                            <td>password</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>New password (min 8 characters)</td>
                        </tr>
                        <tr>
                            <td>password_confirmation</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Confirm new password</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "current_password": "password123",
    "password": "newpassword456",
    "password_confirmation": "newpassword456"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Password changed successfully"
}</code></pre>
                </div>
            </div>

            <div id="meters">
                <h2>Meters</h2>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/meters</span>
                    <p>Get all meters for the authenticated user.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "meter_number": "ZW12345678",
            "meter_type": "prepaid",
            "location": "123 Main St, Harare",
            "status": "active",
            "last_reading": 1250.5,
            "last_reading_date": "2023-05-15T10:00:00.000000Z",
            "installation_date": "2023-01-01T00:00:00.000000Z",
            "is_validated": true,
            "validation_date": "2023-01-02T00:00:00.000000Z",
            "notes": "Main residence meter",
            "created_at": "2023-01-01T00:00:00.000000Z",
            "updated_at": "2023-05-15T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/meters?page=1",
        "last": "http://api.zinwa.com/api/meters?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/meters",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/meters</span>
                    <p>Register a new meter for the authenticated user.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>meter_number</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Unique meter number</td>
                        </tr>
                        <tr>
                            <td>meter_type</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Type of meter (prepaid, postpaid)</td>
                        </tr>
                        <tr>
                            <td>location</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Physical location of the meter</td>
                        </tr>
                        <tr>
                            <td>installation_date</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Date of installation</td>
                        </tr>
                        <tr>
                            <td>notes</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Additional notes about the meter</td>
                        </tr>
                        <tr>
                            <td>validate</td>
                            <td>boolean</td>
                            <td>No</td>
                            <td>Whether to validate the meter with the utility provider</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "meter_number": "ZW87654321",
    "meter_type": "prepaid",
    "location": "456 Park Ave, Bulawayo",
    "notes": "Business premises meter",
    "validate": true
}</code></pre>

                    <h4>Example Response (201 Created)</h4>
                    <pre><code>{
    "message": "Meter registered successfully",
    "meter": {
        "id": 2,
        "user_id": 1,
        "meter_number": "ZW87654321",
        "meter_type": "prepaid",
        "location": "456 Park Ave, Bulawayo",
        "status": "active",
        "last_reading": 0,
        "last_reading_date": null,
        "installation_date": "2023-05-20T13:30:00.000000Z",
        "is_validated": true,
        "validation_date": "2023-05-20T13:30:00.000000Z",
        "notes": "Business premises meter",
        "created_at": "2023-05-20T13:30:00.000000Z",
        "updated_at": "2023-05-20T13:30:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/meters/{meter}</span>
                    <p>Get details for a specific meter.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "id": 1,
    "user_id": 1,
    "meter_number": "ZW12345678",
    "meter_type": "prepaid",
    "location": "123 Main St, Harare",
    "status": "active",
    "last_reading": 1250.5,
    "last_reading_date": "2023-05-15T10:00:00.000000Z",
    "installation_date": "2023-01-01T00:00:00.000000Z",
    "is_validated": true,
    "validation_date": "2023-01-02T00:00:00.000000Z",
    "notes": "Main residence meter",
    "created_at": "2023-01-01T00:00:00.000000Z",
    "updated_at": "2023-05-15T10:00:00.000000Z",
    "user": {
        "id": 1,
        "name": "John Smith",
        "email": "john@example.com",
        "phone": "+1987654321",
        "role": "consumer",
        "status": "active",
        "email_verified": true,
        "phone_verified": true,
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T13:00:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method put">PUT</span>
                    <span class="url">/meters/{meter}</span>
                    <p>Update details for a specific meter.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>location</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Physical location of the meter</td>
                        </tr>
                        <tr>
                            <td>notes</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Additional notes about the meter</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "location": "123 Updated St, Harare",
    "notes": "Updated notes for main residence meter"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Meter updated successfully",
    "meter": {
        "id": 1,
        "user_id": 1,
        "meter_number": "ZW12345678",
        "meter_type": "prepaid",
        "location": "123 Updated St, Harare",
        "status": "active",
        "last_reading": 1250.5,
        "last_reading_date": "2023-05-15T10:00:00.000000Z",
        "installation_date": "2023-01-01T00:00:00.000000Z",
        "is_validated": true,
        "validation_date": "2023-01-02T00:00:00.000000Z",
        "notes": "Updated notes for main residence meter",
        "created_at": "2023-01-01T00:00:00.000000Z",
        "updated_at": "2023-05-20T14:00:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/meters/{meter}/validate</span>
                    <p>Validate a meter with the utility provider.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Meter validated successfully",
    "meter": {
        "id": 1,
        "user_id": 1,
        "meter_number": "ZW12345678",
        "meter_type": "prepaid",
        "location": "123 Updated St, Harare",
        "status": "active",
        "last_reading": 1250.5,
        "last_reading_date": "2023-05-15T10:00:00.000000Z",
        "installation_date": "2023-01-01T00:00:00.000000Z",
        "is_validated": true,
        "validation_date": "2023-05-20T14:30:00.000000Z",
        "notes": "Updated notes for main residence meter",
        "created_at": "2023-01-01T00:00:00.000000Z",
        "updated_at": "2023-05-20T14:30:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/meters/{meter}/consumption</span>
                    <p>Get consumption history for a specific meter.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 1,
            "meter_id": 1,
            "token_id": 5,
            "reading": 1250.5,
            "units_consumed": 50.5,
            "reading_date": "2023-05-15T10:00:00.000000Z",
            "reading_type": "automatic",
            "notes": null,
            "created_at": "2023-05-15T10:00:00.000000Z",
            "updated_at": "2023-05-15T10:00:00.000000Z"
        },
        {
            "id": 2,
            "meter_id": 1,
            "token_id": 4,
            "reading": 1200.0,
            "units_consumed": 75.0,
            "reading_date": "2023-05-01T10:00:00.000000Z",
            "reading_type": "automatic",
            "notes": null,
            "created_at": "2023-05-01T10:00:00.000000Z",
            "updated_at": "2023-05-01T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/meters/1/consumption?page=1",
        "last": "http://api.zinwa.com/api/meters/1/consumption?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/meters/1/consumption",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}</code></pre>
                </div>
            </div>

            <div id="tokens">
                <h2>Tokens</h2>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/tokens</span>
                    <p>Get all tokens for the authenticated user.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 5,
            "user_id": 1,
            "meter_id": 1,
            "transaction_id": 5,
            "token_number": "12345678901234567890",
            "units": 50.5,
            "amount": 75.75,
            "status": "used",
            "generated_at": "2023-05-15T09:00:00.000000Z",
            "used_at": "2023-05-15T10:00:00.000000Z",
            "expires_at": "2023-06-14T09:00:00.000000Z",
            "created_at": "2023-05-15T09:00:00.000000Z",
            "updated_at": "2023-05-15T10:00:00.000000Z"
        },
        {
            "id": 4,
            "user_id": 1,
            "meter_id": 1,
            "transaction_id": 4,
            "token_number": "09876543210987654321",
            "units": 75.0,
            "amount": 112.50,
            "status": "used",
            "generated_at": "2023-05-01T09:00:00.000000Z",
            "used_at": "2023-05-01T10:00:00.000000Z",
            "expires_at": "2023-05-31T09:00:00.000000Z",
            "created_at": "2023-05-01T09:00:00.000000Z",
            "updated_at": "2023-05-01T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/tokens?page=1",
        "last": "http://api.zinwa.com/api/tokens?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/tokens",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/meters/{meter}/tokens</span>
                    <p>Get all tokens for a specific meter.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 5,
            "user_id": 1,
            "meter_id": 1,
            "transaction_id": 5,
            "token_number": "12345678901234567890",
            "units": 50.5,
            "amount": 75.75,
            "status": "used",
            "generated_at": "2023-05-15T09:00:00.000000Z",
            "used_at": "2023-05-15T10:00:00.000000Z",
            "expires_at": "2023-06-14T09:00:00.000000Z",
            "created_at": "2023-05-15T09:00:00.000000Z",
            "updated_at": "2023-05-15T10:00:00.000000Z"
        },
        {
            "id": 4,
            "user_id": 1,
            "meter_id": 1,
            "transaction_id": 4,
            "token_number": "09876543210987654321",
            "units": 75.0,
            "amount": 112.50,
            "status": "used",
            "generated_at": "2023-05-01T09:00:00.000000Z",
            "used_at": "2023-05-01T10:00:00.000000Z",
            "expires_at": "2023-05-31T09:00:00.000000Z",
            "created_at": "2023-05-01T09:00:00.000000Z",
            "updated_at": "2023-05-01T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/meters/1/tokens?page=1",
        "last": "http://api.zinwa.com/api/meters/1/tokens?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/meters/1/tokens",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/tokens/{token}</span>
                    <p>Get details for a specific token.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "id": 5,
    "user_id": 1,
    "meter_id": 1,
    "transaction_id": 5,
    "token_number": "12345678901234567890",
    "units": 50.5,
    "amount": 75.75,
    "status": "used",
    "generated_at": "2023-05-15T09:00:00.000000Z",
    "used_at": "2023-05-15T10:00:00.000000Z",
    "expires_at": "2023-06-14T09:00:00.000000Z",
    "created_at": "2023-05-15T09:00:00.000000Z",
    "updated_at": "2023-05-15T10:00:00.000000Z",
    "user": {
        "id": 1,
        "name": "John Smith",
        "email": "john@example.com",
        "phone": "+1987654321",
        "role": "consumer",
        "status": "active",
        "email_verified": true,
        "phone_verified": true,
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T13:00:00.000000Z"
    },
    "meter": {
        "id": 1,
        "user_id": 1,
        "meter_number": "ZW12345678",
        "meter_type": "prepaid",
        "location": "123 Updated St, Harare",
        "status": "active",
        "last_reading": 1250.5,
        "last_reading_date": "2023-05-15T10:00:00.000000Z",
        "installation_date": "2023-01-01T00:00:00.000000Z",
        "is_validated": true,
        "validation_date": "2023-05-20T14:30:00.000000Z",
        "notes": "Updated notes for main residence meter",
        "created_at": "2023-01-01T00:00:00.000000Z",
        "updated_at": "2023-05-20T14:30:00.000000Z"
    },
    "transaction": {
        "id": 5,
        "user_id": 1,
        "meter_id": 1,
        "reference": "TXN-abcdef1234",
        "amount": 75.75,
        "payment_method": "mobile_money",
        "payment_provider": "EcoCash",
        "status": "completed",
        "currency": "USD",
        "description": "Purchase of 50.5 units for meter ZW12345678",
        "metadata": null,
        "completed_at": "2023-05-15T09:00:00.000000Z",
        "refunded_at": null,
        "created_at": "2023-05-15T08:45:00.000000Z",
        "updated_at": "2023-05-15T09:00:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/tokens/generate</span>
                    <p>Generate a token for a meter (for testing purposes).</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>meter_id</td>
                            <td>integer</td>
                            <td>Yes</td>
                            <td>ID of the meter</td>
                        </tr>
                        <tr>
                            <td>units</td>
                            <td>numeric</td>
                            <td>Yes</td>
                            <td>Number of units to purchase</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "meter_id": 1,
    "units": 100
}</code></pre>

                    <h4>Example Response (201 Created)</h4>
                    <pre><code>{
    "message": "Token generated successfully",
    "token": {
        "id": 6,
        "user_id": 1,
        "meter_id": 1,
        "transaction_id": 6,
        "token_number": "56789012345678901234",
        "units": 100,
        "amount": 150.00,
        "status": "active",
        "generated_at": "2023-05-20T15:00:00.000000Z",
        "used_at": null,
        "expires_at": "2023-06-19T15:00:00.000000Z",
        "created_at": "2023-05-20T15:00:00.000000Z",
        "updated_at": "2023-05-20T15:00:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/tokens/verify</span>
                    <p>Verify a token.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>token_number</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Token number to verify</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "token_number": "56789012345678901234"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Token is valid",
    "token": {
        "id": 6,
        "user_id": 1,
        "meter_id": 1,
        "transaction_id": 6,
        "token_number": "56789012345678901234",
        "units": 100,
        "amount": 150.00,
        "status": "active",
        "generated_at": "2023-05-20T15:00:00.000000Z",
        "used_at": null,
        "expires_at": "2023-06-19T15:00:00.000000Z",
        "created_at": "2023-05-20T15:00:00.000000Z",
        "updated_at": "2023-05-20T15:00:00.000000Z"
    }
}</code></pre>
                </div>
            </div>

            <div id="payments">
                <h2>Payments</h2>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/transactions</span>
                    <p>Get all transactions for the authenticated user.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 6,
            "user_id": 1,
            "meter_id": 1,
            "reference": "TXN-ghijkl5678",
            "amount": 150.00,
            "payment_method": "test",
            "payment_provider": null,
            "status": "completed",
            "currency": "USD",
            "description": "Test token generation",
            "metadata": null,
            "completed_at": "2023-05-20T15:00:00.000000Z",
            "refunded_at": null,
            "created_at": "2023-05-20T15:00:00.000000Z",
            "updated_at": "2023-05-20T15:00:00.000000Z"
        },
        {
            "id": 5,
            "user_id": 1,
            "meter_id": 1,
            "reference": "TXN-abcdef1234",
            "amount": 75.75,
            "payment_method": "mobile_money",
            "payment_provider": "EcoCash",
            "status": "completed",
            "currency": "USD",
            "description": "Purchase of 50.5 units for meter ZW12345678",
            "metadata": null,
            "completed_at": "2023-05-15T09:00:00.000000Z",
            "refunded_at": null,
            "created_at": "2023-05-15T08:45:00.000000Z",
            "updated_at": "2023-05-15T09:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/transactions?page=1",
        "last": "http://api.zinwa.com/api/transactions?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/transactions",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/payments/initiate</span>
                    <p>Initiate a payment for purchasing units.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>meter_id</td>
                            <td>integer</td>
                            <td>Yes</td>
                            <td>ID of the meter</td>
                        </tr>
                        <tr>
                            <td>units</td>
                            <td>numeric</td>
                            <td>Yes</td>
                            <td>Number of units to purchase</td>
                        </tr>
                        <tr>
                            <td>payment_method</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>Payment method (mobile_money, bank_transfer, card, cash)</td>
                        </tr>
                        <tr>
                            <td>payment_provider</td>
                            <td>string</td>
                            <td>Yes (unless payment_method is cash)</td>
                            <td>Payment provider (e.g., EcoCash, OneMoney, Visa)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "meter_id": 1,
    "units": 50,
    "payment_method": "mobile_money",
    "payment_provider": "EcoCash"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Payment initiated successfully",
    "transaction": {
        "id": 7,
        "user_id": 1,
        "meter_id": 1,
        "reference": "TXN-mnopqr9012",
        "amount": 75.00,
        "payment_method": "mobile_money",
        "payment_provider": "EcoCash",
        "status": "pending",
        "currency": "USD",
        "description": "Purchase of 50 units for meter ZW12345678",
        "metadata": null,
        "completed_at": null,
        "refunded_at": null,
        "created_at": "2023-05-20T16:00:00.000000Z",
        "updated_at": "2023-05-20T16:00:00.000000Z"
    },
    "payment_url": "http://api.zinwa.com/api/payments/simulate/TXN-mnopqr9012"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/payments/verify/{reference}</span>
                    <p>Verify a payment by reference.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Payment verified successfully",
    "transaction": {
        "id": 7,
        "user_id": 1,
        "meter_id": 1,
        "reference": "TXN-mnopqr9012",
        "amount": 75.00,
        "payment_method": "mobile_money",
        "payment_provider": "EcoCash",
        "status": "completed",
        "currency": "USD",
        "description": "Purchase of 50 units for meter ZW12345678",
        "metadata": null,
        "completed_at": "2023-05-20T16:05:00.000000Z",
        "refunded_at": null,
        "created_at": "2023-05-20T16:00:00.000000Z",
        "updated_at": "2023-05-20T16:05:00.000000Z"
    },
    "token": "34567890123456789012"
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/payments/webhook</span>
                    <p>Handle payment webhook from payment provider.</p>
                    <div class="authentication-note">
                        <strong>Public Endpoint:</strong> No authentication required
                    </div>

                    <h4>Example Request</h4>
                    <pre><code>{
    "reference": "TXN-mnopqr9012",
    "status": "successful",
    "provider_reference": "ECO123456789",
    "amount": 75.00,
    "currency": "USD",
    "timestamp": "2023-05-20T16:05:00.000000Z"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Webhook processed successfully"
}</code></pre>
                </div>
            </div>

            <div id="tariffs">
                <h2>Tariffs</h2>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/tariffs</span>
                    <p>Get all active tariffs.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "Residential Basic",
            "description": "Basic tariff for residential customers (0-50 units)",
            "rate_per_unit": 0.50,
            "min_units": 0,
            "max_units": 50,
            "tax_percentage": 5.0,
            "service_fee": 2.00,
            "is_active": true,
            "effective_from": "2023-01-01T00:00:00.000000Z",
            "effective_to": null,
            "created_at": "2023-01-01T00:00:00.000000Z",
            "updated_at": "2023-01-01T00:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "Residential Standard",
            "description": "Standard tariff for residential customers (51-200 units)",
            "rate_per_unit": 0.75,
            "min_units": 51,
            "max_units": 200,
            "tax_percentage": 5.0,
            "service_fee": 2.00,
            "is_active": true,
            "effective_from": "2023-01-01T00:00:00.000000Z",
            "effective_to": null,
            "created_at": "2023-01-01T00:00:00.000000Z",
            "updated_at": "2023-01-01T00:00:00.000000Z"
        }
    ]
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/tariffs/calculate</span>
                    <p>Calculate price for a given number of units.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>units</td>
                            <td>numeric</td>
                            <td>Yes</td>
                            <td>Number of units to calculate price for</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "units": 75
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "units": 75,
    "base_amount": 56.25,
    "tax_amount": 2.81,
    "service_fee": 2.00,
    "total_amount": 61.06,
    "tariff": {
        "id": 2,
        "name": "Residential Standard",
        "description": "Standard tariff for residential customers (51-200 units)",
        "rate_per_unit": 0.75,
        "min_units": 51,
        "max_units": 200,
        "tax_percentage": 5.0,
        "service_fee": 2.00,
        "is_active": true,
        "effective_from": "2023-01-01T00:00:00.000000Z",
        "effective_to": null,
        "created_at": "2023-01-01T00:00:00.000000Z",
        "updated_at": "2023-01-01T00:00:00.000000Z"
    }
}</code></pre>
                </div>
            </div>

            <div id="notifications">
                <h2>Notifications</h2>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/notifications</span>
                    <p>Get all notifications for the authenticated user.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "title": "Token Generated",
            "message": "Your token for 50 units has been generated successfully. Token: 34567890123456789012",
            "type": "token",
            "read_at": null,
            "data": {
                "token_id": 7,
                "token_number": "34567890123456789012",
                "units": 50,
                "meter_id": 1,
                "meter_number": "ZW12345678"
            },
            "created_at": "2023-05-20T16:05:00.000000Z",
            "updated_at": "2023-05-20T16:05:00.000000Z",
            "is_read": false
        },
        {
            "id": 2,
            "user_id": 1,
            "title": "Payment Successful",
            "message": "Your payment of USD 75.00 has been completed successfully.",
            "type": "payment",
            "read_at": "2023-05-20T16:10:00.000000Z",
            "data": {
                "transaction_id": 7,
                "reference": "TXN-mnopqr9012",
                "amount": 75.00,
                "currency": "USD"
            },
            "created_at": "2023-05-20T16:05:00.000000Z",
            "updated_at": "2023-05-20T16:10:00.000000Z",
            "is_read": true
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/notifications?page=1",
        "last": "http://api.zinwa.com/api/notifications?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/notifications",
        "per_page": 15,
        "to": 2,
        "total": 2
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/notifications/{notification}/read</span>
                    <p>Mark a notification as read.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Notification marked as read",
    "notification": {
        "id": 1,
        "user_id": 1,
        "title": "Token Generated",
        "message": "Your token for 50 units has been generated successfully. Token: 34567890123456789012",
        "type": "token",
        "read_at": "2023-05-20T16:15:00.000000Z",
        "data": {
            "token_id": 7,
            "token_number": "34567890123456789012",
            "units": 50,
            "meter_id": 1,
            "meter_number": "ZW12345678"
        },
        "created_at": "2023-05-20T16:05:00.000000Z",
        "updated_at": "2023-05-20T16:15:00.000000Z",
        "is_read": true
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method post">POST</span>
                    <span class="url">/notifications/read-all</span>
                    <p>Mark all notifications as read.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "All notifications marked as read"
}</code></pre>
                </div>
            </div>

            <div id="admin">
                <h2>Admin</h2>

                <div class="authentication-note">
                    <strong>Note:</strong> All admin endpoints require authentication with an admin user.
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/admin/dashboard</span>
                    <p>Get dashboard statistics.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "total_users": 15,
    "total_meters": 20,
    "total_tokens": 150,
    "total_revenue": 12500.75,
    "recent_transactions": [
        {
            "id": 7,
            "user_id": 1,
            "meter_id": 1,
            "reference": "TXN-mnopqr9012",
            "amount": 75.00,
            "payment_method": "mobile_money",
            "payment_provider": "EcoCash",
            "status": "completed",
            "currency": "USD",
            "description": "Purchase of 50 units for meter ZW12345678",
            "metadata": null,
            "completed_at": "2023-05-20T16:05:00.000000Z",
            "refunded_at": null,
            "created_at": "2023-05-20T16:00:00.000000Z",
            "updated_at": "2023-05-20T16:05:00.000000Z",
            "user": {
                "id": 1,
                "name": "John Smith",
                "email": "john@example.com"
            },
            "meter": {
                "id": 1,
                "meter_number": "ZW12345678"
            }
        }
    ],
    "users_by_role": [
        {
            "role": "admin",
            "count": 1
        },
        {
            "role": "vendor",
            "count": 2
        },
        {
            "role": "consumer",
            "count": 12
        }
    ],
    "transactions_by_day": [
        {
            "date": "2023-05-01",
            "total": 450.00
        },
        {
            "date": "2023-05-15",
            "total": 75.75
        },
        {
            "date": "2023-05-20",
            "total": 225.00
        }
    ]
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/admin/users</span>
                    <p>Get all users with filtering options.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Query Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>role</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by role (admin, vendor, consumer)</td>
                        </tr>
                        <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by status (active, inactive, suspended)</td>
                        </tr>
                        <tr>
                            <td>search</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Search by name, email, or phone</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "data": [
        {
            "id": 1,
            "name": "John Smith",
            "email": "john@example.com",
            "phone": "+1987654321",
            "role": "consumer",
            "status": "active",
            "email_verified": true,
            "phone_verified": true,
            "last_login_at": "2023-05-20T12:30:00.000000Z",
            "created_at": "2023-05-20T12:00:00.000000Z",
            "updated_at": "2023-05-20T13:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/admin/users?page=1",
        "last": "http://api.zinwa.com/api/admin/users?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/admin/users",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method put">PUT</span>
                    <span class="url">/admin/users/{user}/status</span>
                    <p>Update a user's status.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>New status (active, inactive, suspended)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "status": "inactive"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "User status updated successfully",
    "user": {
        "id": 1,
        "name": "John Smith",
        "email": "john@example.com",
        "phone": "+1987654321",
        "role": "consumer",
        "status": "inactive",
        "email_verified": true,
        "phone_verified": true,
        "last_login_at": "2023-05-20T12:30:00.000000Z",
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T17:00:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/admin/meters</span>
                    <p>Get all meters with filtering options.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Query Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by status (active, inactive, blocked)</td>
                        </tr>
                        <tr>
                            <td>meter_type</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by meter type (prepaid, postpaid)</td>
                        </tr>
                        <tr>
                            <td>search</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Search by meter number, location, or user details</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "meters": {
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "meter_number": "ZW12345678",
                "meter_type": "prepaid",
                "location": "123 Updated St, Harare",
                "status": "active",
                "last_reading": 1250.5,
                "last_reading_date": "2023-05-15T10:00:00.000000Z",
                "installation_date": "2023-01-01T00:00:00.000000Z",
                "is_validated": true,
                "validation_date": "2023-05-20T14:30:00.000000Z",
                "notes": "Updated notes for main residence meter",
                "created_at": "2023-01-01T00:00:00.000000Z",
                "updated_at": "2023-05-20T14:30:00.000000Z",
                "user": {
                    "id": 1,
                    "name": "John Smith",
                    "email": "john@example.com"
                }
            }
        ],
        "links": {
            "first": "http://api.zinwa.com/api/admin/meters?page=1",
            "last": "http://api.zinwa.com/api/admin/meters?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://api.zinwa.com/api/admin/meters",
            "per_page": 15,
            "to": 1,
            "total": 1
        }
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method put">PUT</span>
                    <span class="url">/admin/meters/{meter}/status</span>
                    <p>Update a meter's status.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Request Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>Yes</td>
                            <td>New status (active, inactive, blocked)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Request</h4>
                    <pre><code>{
    "status": "blocked"
}</code></pre>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "message": "Meter status updated successfully",
    "meter": {
        "id": 1,
        "user_id": 1,
        "meter_number": "ZW12345678",
        "meter_type": "prepaid",
        "location": "123 Updated St, Harare",
        "status": "blocked",
        "last_reading": 1250.5,
        "last_reading_date": "2023-05-15T10:00:00.000000Z",
        "installation_date": "2023-01-01T00:00:00.000000Z",
        "is_validated": true,
        "validation_date": "2023-05-20T14:30:00.000000Z",
        "notes": "Updated notes for main residence meter",
        "created_at": "2023-01-01T00:00:00.000000Z",
        "updated_at": "2023-05-20T17:30:00.000000Z"
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/admin/transactions</span>
                    <p>Get all transactions with filtering options.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Query Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by status (pending, completed, failed, refunded)</td>
                        </tr>
                        <tr>
                            <td>payment_method</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by payment method</td>
                        </tr>
                        <tr>
                            <td>search</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Search by reference, user details, or meter number</td>
                        </tr>
                        <tr>
                            <td>date_from</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Filter by date range (start date)</td>
                        </tr>
                        <tr>
                            <td>date_to</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Filter by date range (end date)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "transactions": {
        "data": [
            {
                "id": 7,
                "user_id": 1,
                "meter_id": 1,
                "reference": "TXN-mnopqr9012",
                "amount": 75.00,
                "payment_method": "mobile_money",
                "payment_provider": "EcoCash",
                "status": "completed",
                "currency": "USD",
                "description": "Purchase of 50 units for meter ZW12345678",
                "metadata": null,
                "completed_at": "2023-05-20T16:05:00.000000Z",
                "refunded_at": null,
                "created_at": "2023-05-20T16:00:00.000000Z",
                "updated_at": "2023-05-20T16:05:00.000000Z",
                "user": {
                    "id": 1,
                    "name": "John Smith",
                    "email": "john@example.com"
                },
                "meter": {
                    "id": 1,
                    "meter_number": "ZW12345678"
                }
            }
        ],
        "links": {
            "first": "http://api.zinwa.com/api/admin/transactions?page=1",
            "last": "http://api.zinwa.com/api/admin/transactions?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://api.zinwa.com/api/admin/transactions",
            "per_page": 15,
            "to": 1,
            "total": 1
        }
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/admin/tokens</span>
                    <p>Get all tokens with filtering options.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Query Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>status</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by status (active, used, expired, cancelled)</td>
                        </tr>
                        <tr>
                            <td>search</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Search by token number, user details, or meter number</td>
                        </tr>
                        <tr>
                            <td>date_from</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Filter by date range (start date)</td>
                        </tr>
                        <tr>
                            <td>date_to</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Filter by date range (end date)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "tokens": {
        "data": [
            {
                "id": 7,
                "user_id": 1,
                "meter_id": 1,
                "transaction_id": 7,
                "token_number": "34567890123456789012",
                "units": 50,
                "amount": 75.00,
                "status": "active",
                "generated_at": "2023-05-20T16:05:00.000000Z",
                "used_at": null,
                "expires_at": "2023-06-19T16:05:00.000000Z",
                "created_at": "2023-05-20T16:05:00.000000Z",
                "updated_at": "2023-05-20T16:05:00.000000Z",
                "user": {
                    "id": 1,
                    "name": "John Smith",
                    "email": "john@example.com"
                },
                "meter": {
                    "id": 1,
                    "meter_number": "ZW12345678"
                },
                "transaction": {
                    "id": 7,
                    "reference": "TXN-mnopqr9012"
                }
            }
        ],
        "links": {
            "first": "http://api.zinwa.com/api/admin/tokens?page=1",
            "last": "http://api.zinwa.com/api/admin/tokens?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://api.zinwa.com/api/admin/tokens",
            "per_page": 15,
            "to": 1,
            "total": 1
        }
    }
}</code></pre>
                </div>

                <div class="endpoint">
                    <span class="method get">GET</span>
                    <span class="url">/admin/audit-logs</span>
                    <p>Get audit logs with filtering options.</p>
                    <div class="authentication-note">
                        <strong>Authentication Required:</strong> Bearer Token (Admin)
                    </div>

                    <h4>Query Parameters</h4>
                    <table class="table params-table">
                        <thead>
                        <tr>
                            <th>Parameter</th>
                            <th>Type</th>
                            <th>Required</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>action</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Filter by action type</td>
                        </tr>
                        <tr>
                            <td>user_id</td>
                            <td>integer</td>
                            <td>No</td>
                            <td>Filter by user ID</td>
                        </tr>
                        <tr>
                            <td>search</td>
                            <td>string</td>
                            <td>No</td>
                            <td>Search by action, model type, or user details</td>
                        </tr>
                        <tr>
                            <td>date_from</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Filter by date range (start date)</td>
                        </tr>
                        <tr>
                            <td>date_to</td>
                            <td>date</td>
                            <td>No</td>
                            <td>Filter by date range (end date)</td>
                        </tr>
                        </tbody>
                    </table>

                    <h4>Example Response (200 OK)</h4>
                    <pre><code>{
    "logs": {
        "data": [
            {
                "id": 1,
                "user_id": 1,
                "action": "update_meter_status",
                "model_type": "App\\Models\\Meter",
                "model_id": 1,
                "old_values": {
                    "status": "active"
                },
                "new_values": {
                    "status": "blocked"
                },
                "ip_address": "192.168.1.1",
                "user_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36",
                "created_at": "2023-05-20T17:30:00.000000Z",
                "updated_at": "2023-05-20T17:30:00.000000Z",
                "user": {
                    "id": 1,
                    "name": "John Smith",
                    "email": "john@example.com"
                }
            }
        ],
        "links": {
            "first": "http://api.zinwa.com/api/admin/audit-logs?page=1",
            "last": "http://api.zinwa.com/api/admin/audit-logs?page=1",
            "prev": null,
            "next": null
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 1,
            "path": "http://api.zinwa.com/api/admin/audit-logs",
            "per_page": 15,
            "to": 1,
            "total": 1
        }
    }
}</code></pre>
                </div>
            </div>

            <div id="errors">
                <h2>Error Handling</h2>

                <p>
                    The API uses standard HTTP status codes to indicate the success or failure of a request. In case of an error,
                    the response will include a message explaining what went wrong.
                </p>

                <h3>Common Error Codes</h3>

                <table class="table params-table">
                    <thead>
                    <tr>
                        <th>Status Code</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>400</td>
                        <td>Bad Request - The request was invalid or cannot be served</td>
                    </tr>
                    <tr>
                        <td>401</td>
                        <td>Unauthorized - Authentication is required or has failed</td>
                    </tr>
                    <tr>
                        <td>403</td>
                        <td>Forbidden - The authenticated user does not have permission to access the requested resource</td>
                    </tr>
                    <tr>
                        <td>404</td>
                        <td>Not Found - The requested resource does not exist</td>
                    </tr>
                    <tr>
                        <td>422</td>
                        <td>Unprocessable Entity - The request was well-formed but contains semantic errors (validation failed)</td>
                    </tr>
                    <tr>
                        <td>429</td>
                        <td>Too Many Requests - The user has sent too many requests in a given amount of time</td>
                    </tr>
                    <tr>
                        <td>500</td>
                        <td>Internal Server Error - An error occurred on the server</td>
                    </tr>
                    </tbody>
                </table>

                <h3>Validation Error Example</h3>

                <pre><code>{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    }
}</code></pre>

                <h3>Authentication Error Example</h3>

                <pre><code>{
    "message": "Unauthenticated."
}</code></pre>

                <h3>Authorization Error Example</h3>

                <pre><code>{
    "message": "Unauthorized. You do not have the required role to access this resource."
}</code></pre>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle navigation
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all links
                navLinks.forEach(l => l.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');

                // Scroll to section
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                window.scrollTo({
                    top: targetElement.offsetTop - 20,
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
</body>
</html>

