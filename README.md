# Locations Management API

This is a simple API built to manage locations using Laravel.

## Requirements

- Docker
- Docker Compose

## Installation and Setup

1. Clone this repository:

   ```bash
   git clone https://github.com/ArturRA/location-crud
   ```

2. Navigate to the project directory:

   ```bash
   cd location-crud
   ```

3. Start the Docker containers:

   ```bash
   docker-compose up -d
   ```
   
4. Wait for the laravelapp container to finish running `composer install`(you can monitor the progress in the container logs):

   ```bash
   docker-compose logs -f laravelapp
   ```

5. Run database migrations to create the locations table:

   ```bash
   docker exec -it laravelapp sh -c "php artisan migrate"
   ```

## Usage

### Automated Tests

To check and ensure everything is set up correctly you can run the provided automated tests(that are inside the `Locationtest.php` file) with the following command:

```bash
docker exec -it laravelapp sh -c "php artisan test"
```

### Postman Collection

To facilitate testing you can import the provided `Backend challenge location crud api.postman_collection.json` file into Postman to access all API endpoints and examples on how to use them.

## API Endpoints

- **POST /api/locations**: Create a new location.
- **GET /api/locations/{id}**: Retrieve a specific location by its ID.
- **GET /api/locations**: List all locations or filter them by name.
- **PUT /api/locations/{id}**: Update a location.
