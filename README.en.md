# 🐑 Cult of the Lamb API

> ⚠️ This API is based on the **Cult of the Lamb** video game and is an educational project to practice **Laravel** and **Docker**.

## Readme ES

ESta es la versión en inglés del README. Para la versión en español, consulta el archivo [README.md](README.md).

## 📚 Description

A comprehensive RESTful API with secure authentication using **Laravel Sanctum** and complete user and follower management.
Built with **Laravel** and **Docker** to facilitate development, testing, and deployment in any environment.

## 🚀 Key Features

- ✅ **Secure authentication** with Laravel Sanctum
- ✅ **User management** (registration, login, profile)
- ✅ **Follower management** (create, list, update, delete)
- ✅ **Data validation** on all endpoints
- ✅ **Complete documentation** with usage examples
- ✅ **Docker containerization** for easy deployment
- ✅ **MySQL database** with migrations and seeders

## 🛠️ Technology Stack

| Technology | Version | Description |
|-----------|---------|-------------|
| **Laravel** | 11.x | Backend framework |
| **PHP** | 8.3+ | Programming language |
| **MySQL** | 8.0 | Database |
| **Docker** | Latest | Containerization |
| **Composer** | Latest | PHP dependency manager |
| **Laravel Sanctum** | - | API Authentication |

## 📦 Prerequisites

- **Docker** - [Download](https://www.docker.com/get-started)
- **Docker Compose** - [Installation Instructions](https://docs.docker.com/compose/install/)
- **Git** (optional but recommended)

## 🚀 Quick Start

### Option 1: Automatic Setup Script (Recommended)

```bash
# Clone repository
git clone <repository-url>
cd COTL_CRUD/cotl_api

# Run setup script
chmod +x setup.sh
./setup.sh
```

### Option 2: Manual Installation

```bash
# Navigate to directory
cd COTL_CRUD/cotl_api

# Configure .env file
cp .env.example .env

# Build and start containers
docker-compose up -d --build

# Install dependencies
docker exec -it cotl_api_web composer install

# Generate application key
docker exec -it cotl_api_web php artisan key:generate

# Run migrations and seeders
docker exec -it cotl_api_web php artisan migrate --seed

# Set permissions on Linux (if needed)
sudo chown -R $USER:$USER .
```

✅ The application will be available at `http://localhost:8000`

## 🔐 Test Credentials

After running the setup, you can use these credentials to test the API:

| Email | Password |
|-------|----------|
| lamb@cult.com | password123 |
| goat@cult.com | password123 |

> **Note:** You can create new users using the registration endpoint.

## 📡 API Endpoints

### Authentication

- `POST /api/register` - Register new user
- `POST /api/login` - Login user
- `POST /api/logout` - Logout user (requires authentication)

### Users

- `GET /api/user` - Get authenticated user profile
- `PUT /api/user` - Update profile (requires authentication)

### Followers

- `GET /api/followers` - List all followers
- `POST /api/followers` - Create new follower (requires authentication)
- `GET /api/followers/{id}` - Get specific follower
- `PUT /api/followers/{id}` - Update follower (requires authentication)
- `DELETE /api/followers/{id}` - Delete follower (requires authentication)

## 🧪 Testing the API

### Recommended Tools

- [Postman](https://www.postman.com/) - Complete REST client
- [Thunder Client](https://www.thunderclient.com/) - VS Code extension
- [curl](https://curl.se/) - Command line

### Using Thunder Client

Thunder Client is a VS Code extension that makes API testing easy. Here's the basic workflow:

#### 1. Register User

- Method: `POST`
- URL: `http://localhost:8000/api/register`
- Headers:

  ```txt
  Content-Type: application/json
  Accept: application/json
  ```

- Body (JSON):

  ```JSON
  {
    "name": "The Lamb",
    "email": "lamb@cult.com",
    "password": "password123",
    "password_confirmation": "password123"
  }
  ```

#### 2. Login

- Method: `POST`
- URL: `http://localhost:8000/api/login`
- Headers:

  ```txt
  Content-Type: application/json
  Accept: application/json
  ```

- Body (JSON):

  ```json
  {
    "email": "lamb@cult.com",
    "password": "password123"
  }
  ```

- Response: You'll receive an authentication token that you must use in subsequent requests

#### 3. Use token in authenticated requests

- Additional headers in protected requests:

  ```txt
  Authorization: Bearer {your_token_here}
  ```

Check the `pictures/` folder to see Thunder Client screenshots with real examples.

### Important: Accept Header

⚠️ **Always include this header in your requests:**

```txt
Accept: application/json
```

## 📸 Visual References

In the `pictures/` folder you will find visual examples of requests using Thunder Client:

- `register.png` - User registration
- `login.png` - Login
- `create_follower.png` - Create follower
- `ist_followers.png` - List followers
- `update_follower.png` - Update follower
- `delete_follower.png` - Delete follower

## 📁 Project Structure

```txt
cotl_api/
├── app/
│   ├── Http/Controllers/     # API controllers
│   ├── Models/               # Data models
│   └── Providers/            # Application providers
├── database/
│   ├── migrations/           # Database migrations
│   ├── factories/            # Test factories
│   └── seeders/              # Data seeders
├── routes/
│   └── api.php               # API routes
├── config/                   # Configuration files
└── storage/                  # Application storage
```

## 🐳 Useful Docker Commands

```bash
# View container logs
docker-compose logs -f

# Run artisan commands
docker exec -it cotl_api_web php artisan <command>

# Access container shell
docker exec -it cotl_api_web bash

# Stop containers
docker-compose down

# Restart containers
docker-compose restart
```

## 📄 License

This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

---

<div align="center">
  <sub>Developed with ❤️ by <a href="https://github.com/Lotoz">Lotoz</a></sub>
  <br>
  <sub>Based on the Cult of the Lamb video game - Educational Project</sub>
</div>
