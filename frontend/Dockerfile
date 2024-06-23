FROM node:18-alpine

# Install dependencies
RUN apk add --no-cache \
        curl \
    ;

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .