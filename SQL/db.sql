create database if not exists ecommerce5F;

create table if not exists ecommerce5F.users
(
    id       int not null auto_increment primary key,
    email    varchar(50),
    password varchar(256),
    role_id  int
    );

create table if not exists ecommerce5F.roles
(
    id          int not null auto_increment primary key,
    nome        varchar(50),
    descrizione varchar(500)
    );

create table if not exists ecommerce5F.sessions
(
    id         int not null auto_increment primary key,
    ip         varchar(16),
    data_login datetime,
    user_id    int
    );

create table if not exists ecommerce5F.carts
(
    id      int not null auto_increment primary key,
    user_id int

);

create table if not exists ecommerce5F.cart_products
(
    id int not null auto_increment primay key,
    cart_id    int,
    product_id int,
    quantita   int
);

create table if not exists ecommerce5F.products
(
    id     int not null auto_increment primary key,
    nome   varchar(50),
    prezzo float,
    marca  varchar(50)
    );

alter table ecommerce5F.users
    add foreign key (role_id) references roles (id);

alter table ecommerce5F.carts
    add foreign key (user_id) references users (id);

alter table ecommerce5F.cart_products
    add foreign key (cart_id) references carts (id),
    add foreign key (product_id) references products (id);

alter table ecommerce5F.sessions
    add foreign key (user_id) references users (id);