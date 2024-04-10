# Advanced Messaging System (AMS)

## Introduction

AMS is a state-of-the-art messaging system that integrates Event-Driven Architecture (EDA) with the unparalleled security provided by atmospheric noise encryption. Harnessing the power of random.org's true randomness, AMS is at the forefront of secure digital communications.

## Theoretical Background

### Unleashing the Power of True Randomness

AMS taps into the chaotic and unpredictable nature of atmospheric noise to enhance message security. This approach is grounded in the rich history of atmospheric noise discovery and leverages the complex dynamics that make atmospheric noise a perfect example of true randomness. With this foundation, AMS surpasses traditional pseudo-random algorithms, providing a secure messaging system that is as unpredictable as nature itself.

### A New Frontier in Digital Security

AMS represents a groundbreaking shift in secure communications, taking advantage of the natural entropy provided by atmospheric noise. This not only improves security but also ushers in a new era of digital fairness, where the integrity of data is protected by the laws of nature.

## Technical Stack Overview

- **PHP 8.1**: For responsive server-side logic.
- **Apache**: For a trusted and efficient web server.
- **MariaDB**: For a strong and compatible database system.
- **Redis with PHPRedis**: For message queuing and real-time data processing.
- **Composer**: For dependency management.
- **Docker and Docker Compose**: For creating consistent development and production environments.
- **Git**: For version control.
- **Random.org**: To provide a source of true randomness derived from atmospheric noise.

## Key Features

- **Atmospheric Noise Encryption**: Leveraging Random.org to generate truly random initialization vectors for AES-256-CBC encryption.
- **Event-Driven Real-Time Messaging**: Implementing Redis for efficient and responsive message delivery.
- **Secure User Authentication**: Ensuring safety with modern password hashing and session management techniques.

## Security Considerations

Security is a cornerstone of the Advanced Messaging System. Here are some practices we follow and recommend:

- **Encryption**: We leverage AES-256-CBC encryption, utilizing true randomness from atmospheric noise for initialization vectors to ensure message confidentiality.
- **Data Storage**: Sensitive information is securely stored, employing best practices like encrypted databases and environmental variables for sensitive configurations.
- **Regular Updates**: Keep your AMS instance and its dependencies up to date to mitigate vulnerabilities from outdated software.

We encourage administrators to follow these practices to enhance their AMS deployment security further.


## Getting Started

To begin using AMS, you'll need Docker, Docker Compose, and Git installed on your system.

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

## Usage

After installation, access the AMS Web Interface at `http://localhost:8082/` and start experiencing secure messaging. Navigate to `http://localhost:8083/` for database management with phpMyAdmin.

## Roadmap

Future enhancements include:
- Responsive frontend development using modern web frameworks.
- Group chat capabilities and secure file transfer options.
- Implementation of advanced security features like two-factor authentication.

## Contributing

Contributions are what make the open-source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

- **Adhere to Coding Standards**: Follow the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard for PHP.
- **Write Tests**: Include unit tests for new features or bug fixes.
- **Discuss Big Changes**: For significant changes, please open an issue to discuss the proposal before moving forward with implementation.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Contact

Gabriel Brandão – [@bakill717](https://twitter.com/bakill717) – deostulti2@gmail.com

Project Link: [https://github.com/bakill3/AMS](https://github.com/bakill3/AMS)

## Recent Updates and Troubleshooting

### Enhanced Security and Functionality

- **Atmospheric Noise Encryption**: Improved the implementation of atmospheric noise-based encryption to enhance message security further.
- **Docker Integration**: Streamlined Docker setup for easier deployment and initialization of the AMS environment.

### Troubleshooting Login Issues

- Addressed an issue where login attempts consistently failed due to form data not being correctly received by the server.
- Introduced debugging steps and improved error handling in the login process to provide clearer feedback and easier issue resolution.

### Getting Started Enhancements

- Added detailed instructions for setting up the AMS environment using Docker, including building containers and configuring the environment.
- Clarified the steps for database initialization and provided guidance on secure configuration practices.

### Future Directions

- Plans to introduce group chat capabilities and secure file transfer options to enhance AMS's functionality.
- Looking into implementing advanced security features like two-factor authentication to further secure user accounts.


## Acknowledgements

- [Random.org](https://www.random.org/)
- [Choose an Open Source License](https://choosealicense.com)
- [GitHub Emoji Cheat Sheet](https://www.webpagefx.com/tools/emoji-cheat-sheet)
- [Markdown Guide](https://guides.github.com/features/mastering-markdown/)
- [README Template](https://github.com/othneildrew/Best-README-Template)
