# OutDoorVibez-eCommerce-Website
Web Application for users to create an account to order outdoor gear

Application Overview, Tools & List of Features:

OutDoorVibez is our ecommerce Website created with php as the back-end for the server side. HTML and CSS for design with the help of Bootstrap and Bootstrap Studio for styling and format. The data management is done with a MySQL database with relational tables and entities. This web application allows for users to create an account and order outdoor gear. Admins can manage the users and products on the web application itself without having to go on the database management system. 

Tools: 
  1. Pogramming & Scripting Languages: PHP, HTML, CSS, Bootstrap
  2. Bootstrap Studio 
  3. PHP Eclipse 
  4. PhpMyAdmin
  5. MySQL Workbench

Web Application Features: 
- Users can create account
- Admin permissions- create, edit, delete products and users 
- Search and view a catalog of products 
- Dynamic Shopping Cart 
- Product, Order, and User data storage 
- Non-users can also create orders and purchase products
- Admins can access a sales report 
- Users can utilize coupons 


Design Decisions for Classes, Database Schema, and Folder Structure

Classes: n-Tier Architecture, Layers

All the classes for our web application are either in the data access or business layer. Those in the data access layer are the classes that run the queries and CRUD data throughout the program. The classes in the presentation layer allow access to data while securing and encapsulateing the data access layer methods. The methods work as modifiers that create data from the database. 

Folder Structure:
Our goal for the file structure is to keep the files as organized as possible to allow the easy navigation as we developed these files. Keeping classes, handlers, pages, includes, images, and resources separate. 
 
Database Schema:
We used relational tables and entities for this web application. Every entity has its own table and a primary key to allow uniqueness and for retrieving the entity at a later time. We also used foreign keys because every table/entity has a relationship with another. 


Usability Decisions: Navigation, CSS Design, and Program Flow 

Navigation:
Very clear and easy to follow navigation, nav bar implemented throughout the web application except for the shopping process. 
 
CSS Design: 
With the help of CSS and Boostrap Studio we were able to keep the layout and format of the pages very consistent. The same CSS classes were used through the HTML pages with some in-line styling for exceptions. 

Program Flow: 
Allowing objects in the back-end to be communicated through the front-end from the database a request. 


Limitations & Bugs 

Limitations:
1.	Shipping not yet calculated based on products 
2.	When two or more of the same product are added to cart they do not combine 
3.	No way for the user to manage their own information for orders or user information 
4.	No way that user can see previous order history 
5.	No connection between a non-user and their order after leaving the web application 

Bugs: 
1.	Order can be completed even through the order has no products 
2.	Cannot insert special characters in the text inputs for registering, returns a SQL error, this can be bothersome, adding HTML entities would resolve the issue 


Ideas for Future Versions 
1.	Implement the PayPal API as payment form 
2.	User Profile for users to manage their personal information, billing, shipping, and payment information 
3.	Wishlist/Liked products for users 
4.	Order history for users with the products purchased and details
5.	Prime membership
6.	Admin ability to add/delete/discontinue coupons from admin page
<br>
<h2>Screenshots of all the Important Pages of Our OutdoorVibes Website ⬇️ </h2>
<br>
<h3>Index, Register, and Login Pages:</h3>

![OutdoorVibes1](https://user-images.githubusercontent.com/46502423/175870245-493bbd67-10a7-4b11-9270-ce1a3dc9c91b.png)

![OutdoorVibes1 0](https://user-images.githubusercontent.com/46502423/175870242-4fb77d42-f99b-4ec9-9fd4-03825d750711.png)

![OutdoorVibes2](https://user-images.githubusercontent.com/46502423/175870247-cd45dc63-2063-47c5-9c9f-ee94cc4a07dd.png)

<h3>List of Products and View One Item Pages:</h3>

![OutdoorVibes3new](https://user-images.githubusercontent.com/46502423/175871374-d1f02192-0a58-4d80-930d-99c0a0871cae.png)

![OutdoorVibes4](https://user-images.githubusercontent.com/46502423/175870319-15010351-a791-45ef-b17c-9fd4d3cd93ec.png)

<h3>Working Search Functionality:</h3>

![OutdoorVibesSerch](https://user-images.githubusercontent.com/46502423/175871687-72db9998-6222-4e23-84b3-3857ea5e2ce0.png)

![OutdoorVibesSearchRes](https://user-images.githubusercontent.com/46502423/175871686-43fc24af-c39f-4abc-a0d4-a71cd56e024a.png)

<h3>Cart, Payments, Shipping, and Confirmation Pages:</h3>


![OutdoorVibes5](https://user-images.githubusercontent.com/46502423/175870322-37d8d115-eac3-460d-a68d-01ceb5940b07.png)

![OutdoorVibes6](https://user-images.githubusercontent.com/46502423/175870326-f103350b-aba2-43a6-9922-cc304a313af0.png)

![OutdoorVibes7](https://user-images.githubusercontent.com/46502423/175871896-3befcfe1-0ebc-4090-a80b-882d26d20fbd.png)

![OutdoorVibes8](https://user-images.githubusercontent.com/46502423/175871899-247251b5-012e-48df-a5a0-380c29138940.png)

<h3>Admin Functionality:</h3>
<br>

![OutdoorVibesAdmin](https://user-images.githubusercontent.com/46502423/175872277-dfde722a-9374-49c6-9d18-5ff2914cb09f.png)

![OutdoorVibesAdmin2](https://user-images.githubusercontent.com/46502423/175872282-6d70e3af-ae11-4ead-a0a7-0ec81728ad58.png)

<br>
<br>
Developed by Tyler Wiggins and Ana Sanchez
<h1>Thank You :)</h1>
