<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'Understanding Object-Oriented Programming in PHP',
                'description' => 'A deep dive into Object-Oriented Programming (OOP) principles in PHP and how it can improve your coding skills.',
                'slug' => 'understanding-object-oriented-programming-in-php',
                'featured_image' => 'https://via.placeholder.com/800x600.png?text=OOP+in+PHP',
                'body' => 'Object-Oriented Programming (OOP) is a programming paradigm that uses objects and classes. PHP is an object-oriented language that allows developers to organize their code into logical units. Understanding OOP principles like inheritance, polymorphism, encapsulation, and abstraction can help improve your coding skills and write more efficient and maintainable code.

                In PHP, classes define the structure and behavior of objects, while objects are instances of these classes. You can think of a class as a blueprint for objects. OOP allows you to structure your code in a way that is easier to understand, reuse, and modify over time.

                Inheritance is a mechanism that allows you to create a new class based on an existing class, inheriting its properties and methods. Polymorphism enables you to use the same method name for different purposes, and encapsulation allows you to hide the internal details of a class, exposing only what is necessary. Abstraction, on the other hand, allows you to hide complexity and expose only the essential features.

                PHP’s implementation of OOP makes it easier to manage larger projects, especially when dealing with complex systems. By organizing your code into reusable classes, you can ensure that your code remains modular, readable, and easy to test.',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://cdn.prod.website-files.com/654fd3ad88635290d9845b9e/65ea0d8b1f7ca369883cc2d9_6525256482c9e9a06c7a9d3c%252F65e9e3eee7acb1f2ca2882ca_97f074cf_Object_Oriented_Programming.webp',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'The Importance of Learning Python for Coding Beginners',
                'description' => 'Why Python is one of the best programming languages for beginners and how to start learning it.',
                'slug' => 'importance-of-learning-python-for-coding-beginners',
                'featured_image' => 'https://via.placeholder.com/800x600.png?text=Python+Programming',
                'body' => 'Python is one of the most popular programming languages in the world, and it is known for being beginner-friendly. If you are new to coding, Python is an excellent language to start with. It has a simple syntax, which makes it easy to read and understand. Its versatility allows you to use it for web development, data analysis, machine learning, automation, and more.

                One of the reasons Python is great for beginners is its clear syntax. Unlike other programming languages like C++ or Java, Python uses indentation to define blocks of code, which makes it more readable and reduces the chance of errors. This feature allows beginners to focus on learning programming concepts rather than getting bogged down by complex syntax.

                Python also has a large and supportive community, which means that there are plenty of resources available to help you learn. Whether you prefer books, online courses, or tutorials, there’s a wealth of materials available to help you start your journey as a coder.

                Another reason Python is great for beginners is its flexibility. Python is used in a wide range of applications, from web development frameworks like Django and Flask to powerful libraries for data science and artificial intelligence, such as TensorFlow and Pandas. This means that by learning Python, you can open doors to many different areas of the tech industry.',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://projects-static.raspberrypi.org/collections/assets/python_placeholder.png',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'JavaScript: The Language of the Web',
                'description' => 'How JavaScript has become the go-to language for web development and its role in modern web applications.',
                'slug' => 'javascript-language-of-the-web',
                'featured_image' => 'https://via.placeholder.com/800x600.png?text=JavaScript+Programming',
                'body' => 'JavaScript is the programming language of the web. It powers the dynamic content on most websites, and it has become one of the most essential tools for web developers. JavaScript allows you to create interactive and dynamic user interfaces, making it a key part of modern web development.

                JavaScript works by interacting with HTML and CSS to modify and control the content, structure, and style of a web page. With JavaScript, you can create animations, validate forms, handle user events like clicks and keypresses, and make requests to servers to fetch data without refreshing the page.

                Over the years, JavaScript has evolved from a simple scripting language used for basic interactivity into a full-fledged programming language. Today, JavaScript is used not only for front-end development but also for back-end development with the help of Node.js. This has allowed developers to use JavaScript for both client-side and server-side coding, making it even more powerful.

                Some of the most popular frameworks and libraries in web development, such as React, Angular, and Vue.js, are built using JavaScript. These tools help developers build complex web applications more efficiently. Learning JavaScript opens up a wide range of career opportunities in both front-end and back-end development.',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://www.datocms-assets.com/48401/1628644950-javascript.png',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Mastering Git and GitHub for Version Control',
                'description' => 'An introduction to version control with Git and GitHub and why they are essential for every developer.',
                'slug' => 'mastering-git-and-github-for-version-control',
                'featured_image' => 'https://via.placeholder.com/800x600.png?text=Git+Version+Control',
                'body' => 'Version control is one of the most important skills every developer should learn. Git is a distributed version control system that tracks changes to your code, making it easier to collaborate with others and manage the development process. GitHub is a cloud-based service that hosts Git repositories and provides additional features like issue tracking, pull requests, and project management tools.

                Git allows you to track every change made to a project, providing a detailed history of modifications, and it enables you to collaborate with other developers without fear of overwriting each other’s work. By using branches, you can experiment with new features without affecting the main codebase, and you can merge your changes back once you’re ready.

                GitHub adds a layer of collaboration and sharing by hosting Git repositories online. It allows developers to share code, collaborate on open-source projects, and contribute to other people’s projects. GitHub also provides tools for issue tracking, reviewing pull requests, and organizing projects, making it an essential tool for modern development workflows.

                If you’re working on a project with others or even just tracking your own progress, mastering Git and GitHub will make your development process much smoother and more organized.',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://i0.wp.com/seracoder.com/wp-content/uploads/2024/01/git-and-github.jpg?resize=950%2C500&ssl=1',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Exploring the Benefits of Learning Java for Developers',
                'description' => 'Why Java continues to be a top choice for developers and how it remains relevant in today\'s programming landscape.',
                'slug' => 'exploring-the-benefits-of-learning-java-for-developers',
                'featured_image' => 'https://via.placeholder.com/800x600.png?text=Java+Programming',
                'body' => 'Java is one of the oldest and most widely used programming languages in the world. It has been around for over two decades, and despite the rise of newer languages, Java remains one of the top choices for developers. It is known for its reliability, scalability, and security, making it the preferred choice for building large-scale enterprise applications, Android apps, and more.

                One of the main benefits of learning Java is its platform independence. Java applications are compiled into bytecode, which can run on any machine with a Java Virtual Machine (JVM). This means that Java programs can run on different platforms, such as Windows, macOS, and Linux, without requiring any modifications.

                Another reason Java is still highly relevant is its large ecosystem. Java has a rich set of libraries and frameworks, such as Spring, Hibernate, and Apache Kafka, that make it easier to develop complex applications. Additionally, Java has a large community of developers, which means there are plenty of resources available for learning and problem-solving.

                Java is also widely used in the enterprise world. Many large companies rely on Java to build secure, scalable, and maintainable systems. If you’re interested in enterprise development or Android development, learning Java is an excellent investment for your career.',
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://localo.com/assets/img/definitions/what-is-java.webp',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Mastering Asynchronous Programming in JavaScript',
                'description' => 'An overview of asynchronous programming in JavaScript and how to handle asynchronous tasks with promises, async/await, and callbacks.',
                'slug' => 'mastering-asynchronous-programming-in-javascript',
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://media2.dev.to/dynamic/image/width=1600,height=900,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F42933mbittf2trfqzc91.png',
                'body' => 'Asynchronous programming is a core concept in JavaScript that enables non-blocking operations, which is especially important when dealing with I/O operations like fetching data from a server or reading files. JavaScript provides several ways to handle asynchronous tasks, including callbacks, promises, and the more modern async/await syntax.

                Callbacks were the first method for handling async operations in JavaScript, but they can lead to complex, nested code known as "callback hell." Promises were introduced to simplify this, providing a cleaner way to handle asynchronous results by chaining `.then()` methods. However, promises still required a fair amount of boilerplate code to manage multiple asynchronous tasks.

                The introduction of async/await syntax in JavaScript made asynchronous programming even more readable and easier to understand. With async functions, developers can write asynchronous code in a synchronous style, making the code much more readable and reducing the chances of errors.

                Learning asynchronous programming in JavaScript is essential for building fast and scalable web applications, and the async/await pattern has become the industry standard.',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Building a RESTful API with Node.js and Express',
                'description' => 'A guide to creating a RESTful API with Node.js and Express, including basic CRUD operations and best practices.',
                'slug' => 'building-a-restful-api-with-nodejs-and-express',
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://bs-uploads.toptal.io/blackfish-uploads/components/blog_post_page/4084530/cover_image/retina_1708x683/0604-nodeos-the-javascript-based-operating-system-Waldek_Newsletter-8911cd0372c9aaf2807f9c75cbc00749.png',
                'body' => 'Building a RESTful API with Node.js and Express is one of the most common approaches for developing backend services. Express is a minimal and flexible Node.js web application framework that provides a robust set of features to develop web and mobile applications.

                To get started, first install Node.js and Express. Once installed, you can create routes to handle HTTP requests like GET, POST, PUT, and DELETE. These routes map to specific actions that correspond to the CRUD (Create, Read, Update, Delete) operations on the data.

                For example, a GET request might retrieve a list of users, a POST request might create a new user, a PUT request would update user information, and a DELETE request would remove a user. A RESTful API adheres to principles like statelessness and resource-based actions, which means the API should operate on a set of resources (e.g., users, products) and not store state on the server.

                Express provides middleware to handle requests, authenticate users, validate data, and manage error handling. By building a RESTful API with Node.js and Express, developers can create highly scalable and performant applications.',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Understanding the Basics of Python for Beginners',
                'description' => 'A beginner’s guide to Python programming, covering the basics of syntax, data types, and common use cases.',
                'slug' => 'understanding-the-basics-of-python-for-beginners',
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://img-c.udemycdn.com/course/480x270/2789636_c460.jpg',
                'body' => 'Python is a versatile, high-level programming language that is easy to learn and widely used for a variety of applications, from web development to data science. Python’s simple syntax and readability make it a great choice for beginners.

                In Python, variables are dynamically typed, which means you don’t need to specify their type (such as int or string). Python has several built-in data types, including numbers, strings, lists, tuples, dictionaries, and sets. Understanding these data types and their usage is essential for writing effective Python code.

                Python also uses indentation to define blocks of code instead of braces or keywords, making the code visually easier to follow. The language supports object-oriented programming, allowing you to organize code into reusable classes and objects.

                Python’s ecosystem is vast, with libraries and frameworks for web development (e.g., Django, Flask), data science (e.g., Pandas, NumPy), machine learning (e.g., TensorFlow, Scikit-learn), and more. Learning Python is a great first step toward becoming a versatile developer and is highly recommended for beginners.',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Exploring the Power of TypeScript for Large-Scale Applications',
                'description' => 'Why TypeScript is becoming the go-to choice for developers building large-scale applications, and how it improves upon JavaScript.',
                'slug' => 'exploring-the-power-of-typescript-for-large-scale-applications',
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://cdn.thenewstack.io/media/2022/01/10b88c68-typescript-logo.png',
                'body' => 'TypeScript is a superset of JavaScript that introduces optional static typing to the language. It offers developers the ability to define types for variables, function arguments, and return values, which helps catch type-related errors at compile time rather than runtime.

                One of the biggest advantages of TypeScript is its ability to scale well in large applications. In JavaScript, it’s easy to introduce bugs when working with complex data structures, especially as the codebase grows. TypeScript helps mitigate this risk by allowing developers to define types and interfaces, making the code more predictable and easier to refactor.

                TypeScript is fully compatible with JavaScript, so you can gradually migrate existing JavaScript code to TypeScript. Many popular frameworks and libraries, such as Angular, React, and Vue.js, have official TypeScript support, making it a great choice for modern web development.

                By incorporating TypeScript into your workflow, you can benefit from better tooling, such as autocompletion and type checking, as well as improved code maintainability. TypeScript is quickly becoming the go-to solution for developers building large-scale web applications.',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Getting Started with Django for Web Development',
                'description' => 'A beginner’s guide to Django, a powerful Python web framework, and how to build web applications quickly and efficiently.',
                'slug' => 'getting-started-with-django-for-web-development',
                'user_id' => 2,
                'status' => 'published',
                'featured_image' => 'https://www.coderio.com/wp-content/uploads/2024/12/Django-The-Python-Web-Framework.jpg',
                'body' => 'Django is a high-level Python web framework that promotes rapid development and clean, pragmatic design. It is particularly well-suited for developers who need to build web applications quickly, with a focus on reusability, scalability, and maintainability.

                One of the main features of Django is its "batteries-included" philosophy. The framework comes with built-in components like an authentication system, an admin interface, and tools for handling forms, URLs, and database migrations. This allows developers to spend less time writing boilerplate code and more time focusing on building their application’s unique features.

                Django follows the Model-View-Template (MVT) architectural pattern, similar to the Model-View-Controller (MVC) pattern. In Django, the Model represents the data, the View handles the user interface, and the Template manages how data is presented to the user.

                Django is widely used in the industry and powers many popular websites. It’s a great choice for web developers who want to build secure and scalable web applications while minimizing the complexity of their codebase.',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
