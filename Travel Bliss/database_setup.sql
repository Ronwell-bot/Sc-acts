CREATE DATABASE travel_bliss;
use travel_bliss;
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

-- Table to store hotel details
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

INSERT INTO Hotels (HotelName, Location, PricePerNight, CheckInTime, CheckOutTime, Amenities, HotelImage) VALUES
('Grand Palace Hotel', '123 Royal Street, Metropolis', 200.00, '14:00:00', '12:00:00', 'Pool, Spa, Free Wi-Fi', 'hotelb1.jpg'),
('Sunset Inn', '456 Sunset Avenue, Beach City', 150.00, '15:00:00', '11:00:00', 'Free Parking, Gym', 'hotelb2.jpg');

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

-- Table to store flight details
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
CREATE TABLE TestPrices (
    Price DECIMAL(10, 2)
);

CREATE TABLE Packages (
    PackageID INT PRIMARY KEY AUTO_INCREMENT,
    PackageName VARCHAR(100) NOT NULL,
    Description TEXT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    StartDate DATE NOT NULL,
    EndDate DATE NOT NULL,
    Itinerary TEXT NOT NULL,
    PackageImage VARCHAR(255) NOT NULL
);
-- Insert sample data into Packages table
INSERT INTO Packages (PackageName, Description, Price, StartDate, EndDate, Itinerary, PackageImage) VALUES
('Romantic Paris Getaway', 'A romantic trip to Paris for two.', 1500.00, '2023-12-01', '2023-12-07', 'Day 1: Arrival and Eiffel Tower visit; Day 2: Louvre Museum; Day 3: Seine River Cruise', 'paris_package.jpg'),
('New York City Adventure', 'Explore the best of New York City.', 2000.00, '2023-12-10', '2023-12-15', 'Day 1: Times Square; Day 2: Central Park; Day 3: Statue of Liberty', 'nyc_package.jpg');

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

-- Example of transaction management and concurrency control
START TRANSACTION;

INSERT INTO Flights (FlightNumber, Departure, Arrival, DepartureTime, ArrivalTime, Price, Airline, FlightImage) VALUES ('FN123', 'City A', 'City B', '10:00:00', '12:00:00', 150.00, 'Airline A', 'flight.jpg');
UPDATE Users SET Balance = Balance - 150.00 WHERE UserID = 1;

COMMIT;

SELECT * FROM flights;
