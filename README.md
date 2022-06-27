# OutDoorVibez-eCommerce-Site
Web Application for users to create an account to order outdoor gear

Application Overview, Tools & List of Features:

OutDoorVibez is our ecommerce site created with php as the backend for the server side. HTML and CSS for design with the help of Bootstrap and Bootstrap Studio for styling and format. The data management is done by MySQL database with relational tables and entities. This web application allows for users to create an account and order outdoor gear. Admins can manage the users and products on the web application itself without having to go on the database management system. 

Tools: 
  1. Pogramming & Scripting Languages: PHP, Html, CSS, Bootstrap
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

All the classes for our web application are either in the data access or business layer. Those in the data access layer are the classes that run the queries and CRUD data throughout the program. The classes in the presentation layer allow access to data while securing the data and encapsulate the data access layer methods that modifier or create data from the database. 

Folder Structure:
Our goal for the file structure is to keep the files as organized as possible to allow the easy navigation as we developed these files. Keeping classes, handlers, pages, includes, images and resources separate. 
 
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
1.	Order can be completed even through the order has not products 
2.	Cannot insert special characters in the text inputs for registering, returns a SQL error, this can be bothersome, adding html entities would resolve the issue 


Ideas for Future Versions 
1.	Implement the PayPal API as payment form 
2.	User Profile for users to manage their information and billing, shipping, and payment information 
3.	Wishlist/Liked products for users 
4.	Order history for users with the products purchased and details
5.	Prime membership
6.	Admin ability to add/delete/discontinue coupons from admin page


