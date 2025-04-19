# 📘 API Documentation

This API uses **Laravel Sanctum** for authentication. Most endpoints require an **Bearer token** to access. Authenticated requests must include the `Authorization` header:

---

## 🔐 Auth Endpoints

### `POST /api/auth/register`

Registers a new user.

**Request Body:**

```json
{
    "name": "hak",
    "email": "hak@example.com",
    "password": "your_password"
}
```

**Response:**

```json
{
    "status": 201,
    "success": true,
    "message": "Success",
    "data": {
        "user": {
            "name": "hak",
            "email": "hak@example.com",
            "updated_at": "timestamp",
            "created_at": "timestamp",
            "id": 1
        },
        "token": "your_generated_token"
    }
}
```

---

### `POST /api/auth/login`

Logs in a user.

**Request Body:**

```json
{
    "email": "hak@example.com",
    "password": "your_password"
}
```

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "user": {
            "name": "hak",
            "email": "hak@example.com",
            "updated_at": "timestamp",
            "created_at": "timestamp",
            "id": 1
        },
        "token": "your_generated_token"
    }
}
```

---

### `POST /api/auth/logout`

#### 🔒 Requires Authentication

Logs out the authenticated user.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": "logout"
}
```

---

## 🖼️ Image Compression Endpoints

#### 🔒 All routes below require authentication.

### `GET /api/compress`

List all compressed images.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "original_filename": "image.png",
            "original_size": 1059591,
            "original_filepath": "images/originals/original_path_1asdwq1213.png",
            "compressed_filename": "view_compressed.jpg",
            "compressed_size": 79930,
            "compressed_filepath": "images/compressed/compressed_path.jpg",
            "created_at": "timestamp",
            "updated_at": "timestamp",
            "logs": [
                {
                    "id": 1,
                    "image_id": 1,
                    "message": "Image compressed successfully",
                    "status": "success"
                }
            ]
        },
        {
            "id": 2,
            "user_id": 1,
            "original_filename": "image.png",
            "original_size": 1059591,
            "original_filepath": "images/originals/original_path_12345.png",
            "compressed_filename": "compressed_path_2.jpg",
            "compressed_size": 79930,
            "compressed_filepath": "images/compressed/compressed_path.jpg",
            "created_at": "timestamp",
            "updated_at": "timestamp",
            "logs": [
                {
                    "id": 2,
                    "image_id": 2,
                    "message": "Image compressed successfully",
                    "status": "success"
                }
            ]
        },
        ...
    ]
}
```

---

### `GET /api/compress/{id}`

Get details of a specific compressed image by ID.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "id": 1,
        "user_id": 1,
        "original_filename": "image.png",
        "original_size": 1059591,
        "original_filepath": "images/originals/original_path_12345.png",
        "compressed_filename": "compressed_path_2.jpg",
        "compressed_size": 79930,
        "compressed_filepath": "images/compressed/compressed_path.jpg",
        "created_at": "timestamp",
        "updated_at": "timestamp",
        "logs": [
            {
                "id": 1,
                "image_id": 1,
                "message": "Image compressed successfully",
                "status": "success"
            }
        ]
    }
}
```

---

### `POST /api/compress`

Upload and compress an image.

#### Request Type

**Content-Type:** `multipart/form-data`

**Request Body:**

```json
{
    "image": "file_upload_here",
    "quality": 70,
    "width": 1160,
    "height": 701,
    "format": "jpg"
}
```

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "image_url": "https://www.your-domain.com/storage/images/compressed/compressed_path.jpg",
        "original_size": 1059591,
        "compressed_size": 79930,
        "format": "jpg",
        "resolution": {
            "width": 1160,
            "height": 701
        },
        "saved": {
            "user_id": 1,
            "original_filename": "image.png",
            "original_size": 1059591,
            "original_filepath": "images/originals/original_path_12345.png",
            "compressed_filename": "compressed_path_2.jpg",
            "compressed_size": 79930,
            "compressed_filepath": "images/compressed/compressed_path.jpg",
            "created_at": "timestamp",
            "updated_at": "timestamp",
            "id": 6,
            "logs": [
                {
                    "id": 6,
                    "image_id": 6,
                    "message": "Image compressed successfully",
                    "status": "success"
                }
            ]
        }
    }
}
```

---

## 👤 User Endpoints

#### 🔒 All routes below require authentication.

### `GET /api/users`

Get a list of all users.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": [
        {
            "id": 1,
            "name": "hak",
            "email": "hak@example.com",
            "email_verified_at": null,
            "created_at": "timestamp",
            "updated_at": "timestamp",
            "images_count": 6,
            "images": [
                {
                    "id": 1,
                    "user_id": 1,
                    "original_filepath": "images/originals/original_path_12345.png",
                    "compressed_filepath": "images/compressed/compressed_path.jpg",
                    "logs": [
                        {
                            "id": 1,
                            "image_id": 1,
                            "message": "Image compressed successfully",
                            "status": "success",
                            "created_at": "timestamp"
                        }
                    ]
                },
                ...
            ]
        }
    ]
}
```

---

### `GET /api/users/{id}`

Get details of a specific user by ID.

**Response:**

```json
{
    "status": 200,
    "success": true,
    "message": "Success",
    "data": {
        "id": 1,
        "name": "hak",
        "email": "hak@example.com",
        "email_verified_at": null,
        "created_at": "timestamp",
        "updated_at": "timestamp",
         "images_count": 6,
        "images": [
            {
                "id": 1,
                "user_id": 1,
                "original_filepath": "images/originals/original_path_12345.png",
                "compressed_filepath": "images/compressed/compressed_path.jpg",
                "logs": [
                    {
                        "id": 1,
                        "image_id": 1,
                        "message": "Image compressed successfully",
                        "status": "success",
                        "created_at": "timestamp"
                    }
                ]
            },
            ...
        ]
    }
}
```

---
