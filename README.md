# Advanced Messaging System (AMS) 🚀

## Introduction 🌟

Welcome to AMS - a cutting-edge messaging system that combines the thrill of real-time communication with the security only true randomness can provide. Using atmospheric noise encryption powered by random.org, AMS stands as a bastion of privacy and reliability in the digital communication space.

## Theoretical Background 📚

### Unleashing the Power of True Randomness 🌀

Atmospheric noise, derived from natural and chaotic processes, is unpredictable and perfect for secure data encryption. Unlike deterministic pseudo-random generators, AMS's use of true randomness ensures that each message is shielded by the laws of nature, providing a level of security that is virtually unbreakable.

Read more about this on [https://github.com/bakill3/AMS/blob/develop/LICENSE.md](Notion) or on this [https://drive.google.com/file/d/1DLVSVBIeuG7bleG1NpNQTyPwsFRmyrUx/view?usp=sharing](Google Drive File).

### A New Frontier in Digital Security 🔐

AMS leverages this true randomness to offer a messaging system where each communication is a fortress. It is a pioneering application that not only secures information but does so with the elegance of simplicity and the power of nature.

## Technical Stack Overview 🛠️

Here's a peek at the powerful tools behind AMS:

- **PHP 8.1**: Robust and dynamic server-side scripting.
- **Apache**: High-performance HTTP server.
- **MariaDB**: SQL database that offers high reliability and compatibility.
- **Redis with PHPRedis**: Advanced key-value store for rapid data handling and caching.
- **Composer**: Dependable package management.
- **Docker and Docker Compose**: Essential tools for creating and managing containers, ensuring consistent environments.
- **Git**: Source control to handle versioning and collaboration.
- **Random.org**: Employs atmospheric noise to generate true random numbers.

## Key Features 🌈

- **Atmospheric Noise Encryption**: Utilizes truly random initialization vectors from Random.org for top-tier AES-256-CBC encryption.
- **Event-Driven Real-Time Messaging**: Powered by Redis, AMS offers swift message delivery that's both efficient and reliable.
- **Secure User Authentication**: Features up-to-date password hashing and session management protocols to protect user data.

## Security Considerations 🔍

- **Robust Encryption**: AMS uses AES-256-CBC encryption, with keys generated from true random sources to guarantee confidentiality.
- **Safe Data Storage**: Best practices in data handling are employed, including encrypted storage and secure environmental configurations.
- **Regular Updates**: Keeping software up-to-date is a priority to fend off vulnerabilities.

## Getting Started 🚀

To get your own instance of AMS running:

### Installation Guide

1. **Prerequisites**: Ensure Docker, Docker Compose, and Git are installed.
2. **Clone the Repository**:
   ```bash
   git clone https://github.com/bakill3/AMS.git
   cd AMS```
3. **Build and Run Containers**:
    ```bash
    docker-compose up --build -d```
4. **Configure Environment**:
   Set up your `.env` file with the necessary database configurations and API keys to ensure that all components interact correctly.
   ```plaintext
   # Example .env configuration
   DB_HOST=db
   DB_NAME=ams_database
   DB_USER=ams_user
   DB_PASS=ams_password
   RANDOMORG_API_KEY=your_random_org_api_key_here```

## Roadmap 🛣️

Future enhancements planned for AMS include:
- **Responsive Web Design**: Implementing frameworks like React or Vue.js to improve user interface responsiveness and interactivity.
- **Group Chat Functionality**: Adding features to allow multiple users to communicate in a single session.
- **File Transfer Support**: Enabling secure file sharing within conversations.
- **Two-Factor Authentication (2FA)**: Increasing account security by requiring a second form of identification.

## Contributing 🤝

We welcome contributions from the community! Here's how you can contribute:
1. **Fork the Project**: Create a copy under your GitHub account.
2. **Create your Feature Branch**: `git checkout -b feature/AmazingFeature`
3. **Commit your Changes**: `git commit -m 'Add some AmazingFeature'`
4. **Push to the Branch**: `git push origin feature/AmazingFeature`
5. **Open a Pull Request**

## License 📜

This project is licensed under the MIT License - see the [https://github.com/bakill3/AMS/blob/develop/LICENSE.md](LICENSE) file for details.

## Contact 📧

- **Gabriel Brandão** - : [https://www.linkedin.com/in/gabriel-brandao-2000-pt/](LinkedIn)
- **Project Link**: [https://github.com/bakill3/AMS](https://github.com/bakill3/AMS)

## Acknowledgements 🎉

- [Random.org](https://www.random.org/) for true randomness.
- [GitHub Emoji Cheat Sheet](https://www.webpagefx.com/tools/emoji-cheat-sheet) for emojis used in this document.
- [README Template](https://github.com/othneildrew/Best-README-Template)
