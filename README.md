# Sentiment Analysis Web Application

Web-based Indonesian sentiment analysis application developed as part of my final academic project.

The application compares **Naive Bayes** and **K-Nearest Neighbors (KNN)** based on sentiment prediction results, classification accuracy, and execution time.

This repository contains the **frontend/web application**. The machine learning models and prediction API are maintained separately in a Python Flask backend repository.

---

## Overview

The application provides an interface for analyzing Indonesian text sentiment using two machine learning algorithms:

- Naive Bayes
- K-Nearest Neighbors (KNN)

Users can analyze individual text or datasets and compare the prediction results and performance of both models.

---

## Features

- Single-text sentiment analysis
- CSV dataset analysis
- Text preprocessing
- TF-IDF feature extraction
- Naive Bayes classification
- KNN classification
- Prediction confidence
- Sentiment visualization
- Model accuracy comparison
- Execution time comparison
- Integration with Machine Learning REST API
- Live deployed application

---

## Tech Stack

**Frontend / Web Application**

- Laravel
- Tailwind CSS
- JavaScript
- REST API Integration

**Machine Learning Service**

The machine learning service is maintained in a separate repository and uses Python and Flask to provide sentiment prediction through a REST API.

---

## Architecture

The application is separated into two main components:

```text
User
  │
  ▼
Laravel Web Application
  │
  │ REST API Request
  ▼
Flask Machine Learning API
  │
  ├── Text Preprocessing
  ├── TF-IDF
  ├── Naive Bayes
  └── K-Nearest Neighbors
  │
  ▼
Prediction Result
  │
  ▼
Laravel Web Interface
```

Separating the web application and machine learning service makes development, debugging, and deployment easier to manage.

---

## Live Demo

The application is publicly deployed and can be accessed here:

[Open Sentiment Analysis Application](https://tgasentimen.kesug.com/?i=1)

---

## Machine Learning Backend

The machine learning models and REST API are maintained in a separate repository.

[Machine Learning Backend Repository](BACKEND_REPOSITORY_URL)

---

## Installation

Clone this repository:

```bash
git clone FRONTEND_REPOSITORY_URL
cd FRONTEND_REPOSITORY_NAME
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Build frontend assets:

```bash
npm run build
```

Run the application:

```bash
php artisan serve
```

---

## Configuration

Configure the required environment variables in `.env`, including the URL of the Flask Machine Learning API used by the application.

Do not commit production credentials or sensitive environment variables to the repository.

---

## Related Research

This application was developed as part of my final academic project and is related to the following published research:

**A Comparative Study of Naïve Bayes and K-Nearest Neighbors (KNN) Algorithms in Sentiment Analysis of ChatGPT Usage Among Students**

[Read the Published Article](https://jurnal.polibatam.ac.id/index.php/JAEE/article/view/11464)

---

## Author

**Syahli Kurniawan**

Informatics Engineering  
Politeknik Negeri Lhokseumawe

---

## Project Status

✅ Development completed  
✅ Machine learning integration completed  
✅ Public deployment available
