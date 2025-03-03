CREATE DATABASE travel_bliss;
USE travel_bliss;

-- Create Users table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    PasswordHash VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Sex VARCHAR(10),
    Age INT,
    ProfilePicture VARCHAR(255),
    Name VARCHAR(100)
);

-- Create Destinations table
CREATE TABLE Destinations (
    DestinationID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Location VARCHAR(100),
    ImageURL VARCHAR(255)
);

-- Create Bookings table
CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    DestinationID INT,
    BookingDate DATE,
    Status VARCHAR(50),
    HotelName VARCHAR(100),
    HotelLocation VARCHAR(100),
    PackageID INT,
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (DestinationID) REFERENCES Destinations(DestinationID),
    FOREIGN KEY (PackageID) REFERENCES Packages(PackageID)
);

-- Create Reviews table
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

-- Create Hotels table
CREATE TABLE Hotels (
    HotelID INT PRIMARY KEY AUTO_INCREMENT,
    HotelName VARCHAR(100) NOT NULL,
    Location VARCHAR(100) NOT NULL,
    PricePerNight DECIMAL(10, 2) NOT NULL,
    CheckInTime TIME NOT NULL,
    CheckOutTime TIME NOT NULL,
    Amenities TEXT NOT NULL,
    HotelImage VARCHAR(255) NOT NULL
);

-- Create Flights table
CREATE TABLE Flights (
    FlightID INT PRIMARY KEY AUTO_INCREMENT,
    FlightNumber VARCHAR(50) NOT NULL,
    Departure VARCHAR(100) NOT NULL,
    Arrival VARCHAR(100) NOT NULL,
    DepartureTime TIME NOT NULL,
    ArrivalTime TIME NOT NULL,
    Price DECIMAL(10, 2),
    Airline VARCHAR(100) NOT NULL,
    FlightImage VARCHAR(255)
);

-- Create Packages table
CREATE TABLE Packages (
    PackageID INT PRIMARY KEY AUTO_INCREMENT,
    PackageName VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    StartDate DATE NOT NULL,
    EndDate DATE NOT NULL,
    Itinerary TEXT NOT NULL,
    PackageImage VARCHAR(255) NOT NULL,
    Place VARCHAR(100)
);

-- Create PackageImages table
CREATE TABLE PackageImages (
    ImageID INT PRIMARY KEY AUTO_INCREMENT,
    PackageID INT,
    ImageURL VARCHAR(255) NOT NULL,
    FOREIGN KEY (PackageID) REFERENCES Packages(PackageID)
);

-- Insert sample data into Users table
INSERT INTO Users (UserID, Name, Username, PasswordHash, Email, Sex, Age, ProfilePicture) VALUES
(6, 'Sample User', 'sampleuser', 'hashed_password', 'sampleuser@example.com', 'Male', 30, 'profile.jpg'),
(3, 'First User', 'firstUser', 'hashed_password', 'samp@samp.com', 'Male', 13, 'profile.jpg');

-- Insert sample data into Packages table
INSERT INTO Packages (
    PackageName,
    Description,
    Price,
    StartDate,
    EndDate,
    Itinerary,
    PackageImage,
    Place
) VALUES (
    'Romantic Paris Getaway',
    'A romantic trip to Paris for two.',
    1500.00,
    '2023-12-01',
    '2023-12-07',
    'Day 1: Arrival and Eiffel Tower visit; Day 2: Louvre Museum; Day 3: Seine River Cruise',
    'paris_package.jpg',
    'Paris'
), (
    'New York City Adventure',
    'Explore the best of New York City.',
    2000.00,
    '2023-12-10',
    '2023-12-15',
    'Day 1: Times Square; Day 2: Central Park; Day 3: Statue of Liberty',
    'nyc_package.jpg',
    'New York City'
);

-- Insert sample data into PackageImages table
INSERT INTO PackageImages (PackageID, ImageURL) VALUES
(1, 'paris_image1.jpg'),
(1, 'paris_image2.jpg'),
(2, 'nyc_image1.jpg'),
(2, 'nyc_image2.jpg'),
(1, 'parisp.jpg'),
(1, 'parisp2.jpg'),
(1, 'parisp3.jpg'),
(1, 'parisp4.jpg'),
(2, 'nycp.jpg'),
(2, 'nycp2.jpg'),
(2, 'nycp3.jpg');

-- Update PackageID = 2
UPDATE Packages
SET
    PackageImage2 = 'nycp.jpg',
    PackageImage3 = 'nycp2.jpg',
    PackageImage4 = 'nycp3.jpg'
WHERE
    PackageID = 2;

-- Update PackageID = 1
UPDATE Packages
SET
    PackageImage = 'parisp.jpg',
    PackageImage2 = 'parisp2.jpg',
    PackageImage3 = 'paris.jpg',
    PackageImage4 = 'parisp3.jpg',
    PackageImage5 = 'parisp4.jpg'
WHERE
    PackageID = 1;

-- Example of transaction management and concurrency control
START TRANSACTION;

INSERT INTO Flights (FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Price, Airline, FlightImage) VALUES ('FN123', 'City A', 'City B', '10:00:00', '12:00:00', 150.00, 'Airline A', 'flight.jpg');
UPDATE Users SET Balance = Balance - 150.00 WHERE UserID = 1;
INSERT INTO Bookings (Price) VALUES (24000);

COMMIT;

-- Select all records from bookings and packages
SELECT * FROM Bookings;
SELECT * FROM Packages;

-- Delete a package
DELETE FROM Packages WHERE PackageID = 2;




-- Transaction Management
START TRANSACTION;

INSERT INTO Flights (FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Price, Airline, FlightImage) VALUES ('FN123', 'City A', 'City B', '10:00:00', '12:00:00', 150.00, 'Airline A', 'flight.jpg');
UPDATE Users SET Balance = Balance - 150.00 WHERE UserID = 1;
INSERT INTO Bookings (Price) VALUES (24000);
COMMIT;

-- Joins
SELECT Users.Username, Bookings.BookingDate, Destinations.Name
FROM Bookings
JOIN Users ON Bookings.UserID = Users.UserID
JOIN Destinations ON Bookings.DestinationID = Destinations.DestinationID;

-- Create indexes to improve performance
CREATE INDEX idx_user_email ON Users(Email);
CREATE INDEX idx_destination_name ON Destinations(Name);
CREATE INDEX idx_booking_user ON Bookings(UserID);
CREATE INDEX idx_booking_destination ON Bookings(DestinationID);
CREATE INDEX idx_review_user ON Reviews(UserID);
CREATE INDEX idx_review_destination ON Reviews(DestinationID);
CREATE INDEX idx_flight_number ON Flights(FlightNumber);
CREATE INDEX idx_hotel_name ON Hotels(HotelName);
CREATE INDEX idx_package_name ON Packages(PackageName);

-- Example of using aggregate functions
SELECT AVG(Price) AS AverageFlightPrice FROM Flights;
SELECT COUNT(*) AS TotalBookings FROM Bookings WHERE Status = 'Confirmed';

-- Example of using joins
SELECT Users.Username, Bookings.BookingDate, Destinations.Name
FROM Bookings
JOIN Users ON Bookings.UserID = Users.UserID
JOIN Destinations ON Bookings.DestinationID = Destinations.DestinationID;

-----------------------------------

CREATE DATABASE travel_bliss;
USE travel_bliss;

-- Create Users table
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) NOT NULL,
    PasswordHash VARCHAR(255) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Sex VARCHAR(10),
    Age INT,
    ProfilePicture VARCHAR(255),
    Name VARCHAR(100)
);

-- Create Destinations table
CREATE TABLE Destinations (
    DestinationID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    Location VARCHAR(100),
    ImageURL VARCHAR(255)
);

-- Create Bookings table
CREATE TABLE Bookings (
    BookingID INT PRIMARY KEY AUTO_INCREMENT,
    UserID INT,
    DestinationID INT,
    BookingDate DATE,
    Status VARCHAR(50),
    HotelID INT,
    PackageID INT,
    Price DECIMAL(10, 2),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    FOREIGN KEY (DestinationID) REFERENCES Destinations(DestinationID),
    FOREIGN KEY (HotelID) REFERENCES Hotels(HotelID),
    FOREIGN KEY (PackageID) REFERENCES Packages(PackageID)
);

-- Create Reviews table
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

-- Create Hotels table
CREATE TABLE Hotels (
    HotelID INT PRIMARY KEY AUTO_INCREMENT,
    HotelName VARCHAR(100) NOT NULL,
    Location VARCHAR(100) NOT NULL,
    PricePerNight DECIMAL(10, 2) NOT NULL,
    CheckInTime TIME NOT NULL,
    CheckOutTime TIME NOT NULL,
    Amenities TEXT NOT NULL,
    HotelImage VARCHAR(255) NOT NULL
);

-- Create Flights table
CREATE TABLE Flights (
    FlightID INT PRIMARY KEY AUTO_INCREMENT,
    FlightNumber VARCHAR(50) NOT NULL,
    Departure VARCHAR(100) NOT NULL,
    Arrival VARCHAR(100) NOT NULL,
    DepartureTime TIME NOT NULL,
    ArrivalTime TIME NOT NULL,
    Price DECIMAL(10, 2),
    Airline VARCHAR(100) NOT NULL,
    FlightImage VARCHAR(255)
);

-- Create Packages table
CREATE TABLE Packages (
    PackageID INT PRIMARY KEY AUTO_INCREMENT,
    PackageName VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    StartDate DATE NOT NULL,
    EndDate DATE NOT NULL,
    Itinerary TEXT NOT NULL,
    PackageImage VARCHAR(255) NOT NULL,
    Place VARCHAR(100)
);

-- Create PackageImages table
CREATE TABLE PackageImages (
    ImageID INT PRIMARY KEY AUTO_INCREMENT,
    PackageID INT,
    ImageURL VARCHAR(255) NOT NULL,
    FOREIGN KEY (PackageID) REFERENCES Packages(PackageID)
);

-- Insert sample data into Users table
INSERT INTO Users (UserID, Name, Username, PasswordHash, Email, Sex, Age, ProfilePicture) VALUES
(6, 'Sample User', 'sampleuser', 'hashed_password', 'sampleuser@example.com', 'Male', 30, 'profile.jpg'),
(3, 'First User', 'firstUser', 'hashed_password', 'samp@samp.com', 'Male', 13, 'profile.jpg');

-- Insert sample data into Packages table
INSERT INTO Packages (
    PackageName,
    Description,
    Price,
    StartDate,
    EndDate,
    Itinerary,
    PackageImage,
    Place
) VALUES (
    'Romantic Paris Getaway',
    'A romantic trip to Paris for two.',
    1500.00,
    '2023-12-01',
    '2023-12-07',
    'Day 1: Arrival and Eiffel Tower visit; Day 2: Louvre Museum; Day 3: Seine River Cruise',
    'paris_package.jpg',
    'Paris'
), (
    'New York City Adventure',
    'Explore the best of New York City.',
    2000.00,
    '2023-12-10',
    '2023-12-15',
    'Day 1: Times Square; Day 2: Central Park; Day 3: Statue of Liberty',
    'nyc_package.jpg',
    'New York City'
);

-- Insert sample data into PackageImages table
INSERT INTO PackageImages (PackageID, ImageURL) VALUES
(1, 'paris_image1.jpg'),
(1, 'paris_image2.jpg'),
(2, 'nyc_image1.jpg'),
(2, 'nyc_image2.jpg');

-- Insert sample data into Hotels table
INSERT INTO Hotels (HotelName, Location, PricePerNight, CheckInTime, CheckOutTime, Amenities, HotelImage) VALUES
('Hotel Paris', 'Paris', 200.00, '14:00:00', '12:00:00', 'Free WiFi, Breakfast included', 'hotel_paris.jpg'),
('Hotel NYC', 'New York City', 250.00, '15:00:00', '11:00:00', 'Free WiFi, Gym', 'hotel_nyc.jpg');

-- Insert sample data into Flights table
INSERT INTO Flights (FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Price, Airline, FlightImage) VALUES
('FN123', 'City A', 'City B', '10:00:00', '12:00:00', 150.00, 'Airline A', 'flight.jpg'),
('FN456', 'City C', 'City D', '14:00:00', '16:00:00', 200.00, 'Airline B', 'flight2.jpg');

-- Insert sample data into Bookings table
INSERT INTO Bookings (UserID, DestinationID, BookingDate, Status, HotelID, PackageID, Price) VALUES
(6, 1, '2023-12-01', 'Confirmed', 1, 1, 1500.00),
(3, 2, '2023-12-10', 'Pending', 2, 2, 2000.00);

-- Example of transaction management and concurrency control
START TRANSACTION;

INSERT INTO Flights (FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Price, Airline, FlightImage) VALUES ('FN789', 'City E', 'City F', '18:00:00', '20:00:00', 180.00, 'Airline C', 'flight3.jpg');
UPDATE Users SET Balance = Balance - 180.00 WHERE UserID = 6;
INSERT INTO Bookings (UserID, DestinationID, BookingDate, Status, HotelID, PackageID, Price) VALUES (6, 1, '2023-12-15', 'Confirmed', 1, 1, 180.00);

COMMIT;

-- Select all records from bookings and packages
SELECT * FROM Bookings;
SELECT * FROM Packages;

-- Delete a package
DELETE FROM Packages WHERE PackageID = 2;

-- Joins
SELECT Users.Username, Bookings.BookingDate, Destinations.Name
FROM Bookings
JOIN Users ON Bookings.UserID = Users.UserID
JOIN Destinations ON Bookings.DestinationID = Destinations.DestinationID;

-- Create indexes to improve performance
CREATE INDEX idx_user_email ON Users(Email);
CREATE INDEX idx_destination_name ON Destinations(Name);
CREATE INDEX idx_booking_user ON Bookings(UserID);
CREATE INDEX idx_booking_destination ON Bookings(DestinationID);
CREATE INDEX idx_review_user ON Reviews(UserID);
CREATE INDEX idx_review_destination ON Reviews(DestinationID);
CREATE INDEX idx_flight_number ON Flights(FlightNumber);
CREATE INDEX idx_hotel_name ON Hotels(HotelName);
CREATE INDEX idx_package_name ON Packages(PackageName);

-- Example of using aggregate functions
SELECT AVG(Price) AS AverageFlightPrice FROM Flights;
SELECT COUNT(*) AS TotalBookings FROM Bookings WHERE Status = 'Confirmed';

-- Example of using joins
SELECT Users.Username, Bookings.BookingDate, Destinations.Name
FROM Bookings
JOIN Users ON Bookings.UserID = Users.UserID
JOIN Destinations ON Bookings.DestinationID = Destinations.DestinationID;