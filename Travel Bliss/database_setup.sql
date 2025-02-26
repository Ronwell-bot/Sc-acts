-- Table to store user details
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    PasswordHash VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Sex VARCHAR(10),
    Age INT,
    ProfilePicture VARCHAR(255)
);

-- Table to store destination details
CREATE TABLE Destinations (
    DestinationID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Location VARCHAR(100),
    ImageURL VARCHAR(255)
);

-- Table to store booking details
CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    DestinationID INT,
    BookingDate DATE,
    Status VARCHAR(50),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (DestinationID) REFERENCES Destinations(DestinationID)
);

-- Table to store reviews
CREATE TABLE Reviews (
    ReviewID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    DestinationID INT,
    Rating INT CHECK (Rating >= 1 AND Rating <= 5),
    Comment TEXT,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (DestinationID) REFERENCES Destinations(DestinationID)
);

-- Insert sample data into Users table
INSERT INTO Users (Username, PasswordHash, Email) VALUES
('john_doe', 'hashed_password_1', 'john@example.com'),
('jane_doe', 'hashed_password_2', 'jane@example.com');

-- Insert sample data into Destinations table
INSERT INTO Destinations (Name, Description, Location, ImageURL) VALUES
('Paris', 'The city of lights', 'France', 'images/paris.jpg'),
('New York', 'The city that never sleeps', 'USA', 'images/new_york.jpg');

-- Insert sample data into Bookings table
INSERT INTO Bookings (UserID, DestinationID, BookingDate, Status) VALUES
(1, 1, '2023-12-01', 'Confirmed'),
(2, 2, '2023-12-15', 'Pending');

-- Insert sample data into Reviews table
INSERT INTO Reviews (UserID, DestinationID, Rating, Comment) VALUES
(1, 1, 5, 'Amazing experience!'),
(2, 2, 4, 'Great place to visit.');
