FROM golang:latest

RUN apt-get update \
    && apt-get -y install \
      npm \
      git \
      tesseract-ocr \
      tesseract-ocr-all \
      imagemagick \
      libicu-dev \
      libicu-dev \
      libcairo2-dev \
      libtesseract-dev \
      ca-certificates
WORKDIR /var/www/html