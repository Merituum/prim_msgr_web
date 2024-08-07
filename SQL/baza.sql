CREATE TABLE Users (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Login VARCHAR(50) NOT NULL,
    Haslo VARCHAR(100) NOT NULL,
    PytaniePomocnicze VARCHAR(255) NOT NULL,
    OdpowiedzNaPytanie VARCHAR(255) NOT NULL
);

CREATE TABLE Wiadomosci (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_wysylajacego INT NOT NULL,
    ID_odbierajacego INT NOT NULL,
    content VARCHAR(255) NOT NULL,
    FOREIGN KEY (ID_wysylajacego) REFERENCES Users(ID),
    FOREIGN KEY (ID_odbierajacego) REFERENCES Users(ID)
);

CReATE TABLE friendship (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ID_user INT NOT NULL,
    ID_user_friends INT NOT NULL,
    FOREIGN KEY (ID_user) REFERENCES Users(ID),
    FOREIGN KEY (ID_user_friends) REFERENCES Users(ID)
);
