# 🍽️ Microservices Architecture for Food Ordering System

This system is composed of four microservices, each in a separate repository, and coordinated via Docker Compose.

---

## 🧭 1. API Gateway & Authentication *(Node.js - Express & JWT)*
- **Responsibilities**:
  - Routes API requests to appropriate microservices
  - Manages authentication using JWT
- **Tech Stack**: Node.js, Express, JWT
- **Folder Structure**:

```text
📂 api-gateway
├── src/
│   ├── routes/
│   ├── middlewares/
│   ├── controllers/
│   ├── services/
│   ├── index.js
│   ├── app.js
├── .env
├── Dockerfile
├── package.json
├── docker-compose.yml
```

---

## 🍴 2. Restaurant Service *(Laravel)*
- **Responsibilities**:
  - Manages restaurant data (CRUD operations, menus)
  - Exposes APIs for restaurant-related operations
- **Tech Stack**: Laravel, MySQL
- **Folder Structure**:

```text
📂 restaurant-service
├── app/
├── bootstrap/
├── config/
├── database/
├── routes/
│   ├── api.php
├── storage/
├── .env
├── Dockerfile
├── docker-compose.yml
├── composer.json
```

---

## 🛒 3. Order Service *(Spring Boot)*
- **Responsibilities**:
  - Handles order processing (create/update/retrieve)
  - Manages order statuses
- **Tech Stack**: Spring Boot, PostgreSQL/MySQL
- **Folder Structure**:

```text
📂 order-service
├── src/main/java/com/example/order/
│   ├── controllers/
│   ├── services/
│   ├── repositories/
│   ├── models/
├── src/main/resources/
│   ├── application.yml
├── .env
├── Dockerfile
├── docker-compose.yml
├── pom.xml
```

---

## 💳 4. Payment Service *(Spring Boot)*
- **Responsibilities**:
  - Processes payments
  - Integrates with third-party payment gateways
- **Tech Stack**: Spring Boot, PostgreSQL/MySQL
- **Folder Structure**:

```text
📂 payment-service
├── src/main/java/com/example/payment/
│   ├── controllers/
│   ├── services/
│   ├── repositories/
│   ├── models/
├── src/main/resources/
│   ├── application.yml
├── .env
├── Dockerfile
├── docker-compose.yml
├── pom.xml
```

---

## 🐳 Docker & Docker Compose
Each service has its own `Dockerfile`. At the root level, all services are managed with a single `docker-compose.yml` file.

### 📁 Root Folder Structure:
```text
📂 food-ordering-system
├── api-gateway/
├── restaurant-service/
├── order-service/
├── payment-service/
├── docker-compose.yml
```

### 🧩 Example: docker-compose.yml
```yaml
version: "3.8"
services:
  api-gateway:
    build: ./api-gateway
    ports:
      - "3000:3000"
    depends_on:
      - restaurant-service
      - order-service
      - payment-service
    environment:
      - NODE_ENV=production

  restaurant-service:
    build: ./restaurant-service
    ports:
      - "8000:8000"
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_USER=root
      - DB_PASSWORD=root
      - DB_DATABASE=restaurants

  order-service:
    build: ./order-service
    ports:
      - "8080:8080"
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_USER=root
      - DB_PASSWORD=root
      - DB_DATABASE=orders

  payment-service:
    build: ./payment-service
    ports:
      - "8081:8081"
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_USER=root
      - DB_PASSWORD=root
      - DB_DATABASE=payments

  db:
    image: mysql:8
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: restaurants
    ports:
      - "3306:3306"
```

---

✅ *Fully containerized, modular, scalable microservices system using Docker & multi-repo strategy.*
