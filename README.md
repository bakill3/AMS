# Advanced Messaging System (Alpha) - In Progress

## Introduction
AMS leverages the robustness of Event-Driven Architecture (EDA) with the unpredictability of atmospheric noise for encryption to provide a secure messaging platform. By integrating random.org's atmospheric noise data, AMS introduces an additional layer of security in digital communication.

## Technical Stack Overview
- **PHP 8.1**: For server-side logic.
- **Apache**: Reliable HTTP server.
- **MariaDB**: Database storage, compatible with MySQL.
- **Redis with PHPRedis**: For EDA and message queuing.
- **Composer**: Dependency management.
- **Docker and Docker Compose**: Environment consistency.
- **Git**: Version control.
- **Random.org**: Source of true randomness derived from atmospheric noise.

## Why These Technologies?
Chosen for their security, performance, and developer experience, these technologies provide a stable foundation, reliable data storage, efficient real-time applications, and an unmatched level of encryption security.

## Key Features
- **Atmospheric Noise Encryption**: True randomness for enhanced security.
- **Event-Driven Architecture**: Scalable and responsive messaging.
- **Secure User Authentication**: Modern security practices for PHP.

## Installation Guide
1. **Prerequisites**: Docker, Docker Compose, and Git.
2. **Clone the Repository**:
    ```bash
    git clone https://github.com/bakill3/AMS.git
    cd AMS
    ```
3. **Build and Run Containers**:
    ```bash
    docker-compose up --build -d
    ```
4. **Environment Configuration**: Set up `.env` for database and API keys.
5. **Database Initialization**: Use phpMyAdmin to set up the schema.
6. **Start Messaging**: Access the web interface at `http://localhost:8082/`.

## How It Works
1. **Registration and Login**: With hashed passwords and session management.
2. **Encryption**: Using AES-256-CBC with randomness from random.org.
3. **Real-Time Messaging**: Redis for message delivery.

## Next Steps
- Responsive frontend development.
- Implement group chat and file sharing.
- Add two-factor authentication for enhanced security.

## Conclusion
AMS is a leap forward in secure messaging, harnessing the power of atmospheric noise to secure communications, demonstrating the potential of integrating cutting-edge technologies into the secure digital communication realm.
