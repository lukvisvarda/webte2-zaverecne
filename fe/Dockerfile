# # Use an official Node.js runtime as a parent image
# FROM node:16.15-alpine3.14

# # Set the working directory in the container to /app
# WORKDIR /app

# # Copy the package.json and package-lock.json files to the container
# # COPY package*.json ./
# COPY package.json .

# # Install dependencies
# RUN npm install --force

# # Copy the rest of the application files to the container
# COPY . .


# # Build the application for production
# RUN npm run build

# # Set the command to run when the container starts
# CMD ["npm", "run", "serve"]

# Use an official Node.js runtime as a parent image
FROM node:16.15-alpine3.14

# Set the working directory in the container to /app
WORKDIR /app

# Copy the package.json and package-lock.json files to the container
COPY package.json .

# Install dependencies
RUN npm install

# Copy the rest of the application files to the container
COPY . .

# Build the application for production
RUN npm run build

# Set the command to run when the container starts
CMD ["npm", "run", "serve"]