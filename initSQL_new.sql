-- Creating "webproject_new" Database
DROP DATABASE IF EXISTS webproject_new;
CREATE DATABASE webproject_new;

-- Using the Database
USE webproject_new;

-- Creating "student" Table
CREATE TABLE `webproject_new`.`student` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "teacher" Table
CREATE TABLE `webproject_new`.`teacher` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `education` VARCHAR(1000) NOT NULL , `description` VARCHAR(1000) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "admin" Table
CREATE TABLE `webproject_new`.`admin` ( `email` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , PRIMARY KEY (`email`)) ENGINE = InnoDB;

-- Creating "tutorial_catageory" Table
CREATE TABLE `webproject_new`.`tutorial_categeory` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "tutorial" Table
CREATE TABLE `webproject_new`.`tutorial` ( `id` INT NOT NULL AUTO_INCREMENT , `category_id` INT NOT NULL , `instructor` VARCHAR(100) NOT NULL , `title` VARCHAR(100) NOT NULL , `description` VARCHAR(1000) NOT NULL , `video` VARCHAR(100) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "paragraph" Table
CREATE TABLE `webproject_new`.`paragraph` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `heading` VARCHAR(100) NOT NULL , `content` VARCHAR(5000) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "quiz" Table
CREATE TABLE `webproject_new`.`quiz` ( `id` INT NOT NULL AUTO_INCREMENT , `tutorial_id` INT NOT NULL , `topic` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "question" Table
CREATE TABLE `webproject_new`.`question` ( `id` INT NOT NULL AUTO_INCREMENT , `quiz_id` INT NOT NULL , `statement` VARCHAR(1000) NOT NULL , `option1` VARCHAR(100) NOT NULL , `option2` VARCHAR(100) NOT NULL , `option3` VARCHAR(100) NULL , `option4` VARCHAR(100) NULL , `correct_option` VARCHAR(100) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "student_tutorial_bridge" Table
CREATE TABLE `webproject_new`.`student_tutorial_bridge` ( `id` INT NOT NULL AUTO_INCREMENT , `student_email` VARCHAR(100) NOT NULL , `tutorial_id` INT NOT NULL , `tutorial_rating` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Creating "student_quiz_bridge" Table
CREATE TABLE `webproject_new`.`student_quiz_bridge` ( `id` INT NOT NULL AUTO_INCREMENT , `student_email` VARCHAR(100) NOT NULL , `quiz_id` INT NOT NULL , `quiz_score` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

-- Adding Foregin Key Reference from "tutorial" to "tutorial_catageory"
ALTER TABLE tutorial 
    ADD CONSTRAINT category_id_inTuorial
    FOREIGN KEY (category_id)
    REFERENCES tutorial_categeory(id)
    ON DELETE CASCADE;

-- Adding Foregin Key Reference from "tutorial" to "teacher"
ALTER TABLE tutorial 
    ADD CONSTRAINT instructor_inTuorial
    FOREIGN KEY (instructor)
    REFERENCES teacher(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "paragraph "to "tutorial"
ALTER TABLE paragraph
    ADD CONSTRAINT tutorial_id_inParagraph
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "quiz "to "tutorial"
ALTER TABLE quiz
    ADD CONSTRAINT tutorial_id_inQuiz
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "question "to "quiz"
ALTER TABLE question
    ADD CONSTRAINT quiz_id_inQuestion
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "student"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT student_email_inSTB
    FOREIGN KEY (student_email)
    REFERENCES student(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_tutorial_bridge "to "tutorial"
ALTER TABLE student_tutorial_bridge
    ADD CONSTRAINT tutorial_id_inSTB
    FOREIGN KEY (tutorial_id)
    REFERENCES tutorial(id)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_quiz_bridge "to "student"
ALTER TABLE student_quiz_bridge
    ADD CONSTRAINT student_email_inSQB
    FOREIGN KEY (student_email)
    REFERENCES student(email)
    ON DELETE CASCADE;

-- Adding the Foregin Key reference from "student_quiz_bridge "to "quiz"
ALTER TABLE student_quiz_bridge
    ADD CONSTRAINT quiz_id_inSQB
    FOREIGN KEY (quiz_id)
    REFERENCES quiz(id)
    ON DELETE CASCADE;

-- Populating "student" Table
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("rafey@example.com",   "Abdul Rafey",   "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("laraib@example.com",  "Laraib Arjamand",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("fatima@example.com",  "Fatima Khalid",  "12345678");
INSERT INTO `student`(`email`, `username`, `password`) VALUES ("ghazala@example.com", "Ghazala Bibi", "12345678");

-- Populating "teacher" Table
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`) VALUES ("qaiser@example.com", "Qaiser Riaz",     "12345678", "PhD in xyz, From abc University",   "I am a Professor at NUST, Islamabad, Pakistan. I teach Web Development to 2nd and 3rd Year Students.");
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`) VALUES ("tofeeq@example.com", "Tofeq ur Rehman", "12345678", "PhD in qwe, From def University",   "I am a Professor at NUST, Islamabad, Pakistan. I teach Computer Organization and Operating Systems to 2nd and 3rd Year Students.");
INSERT INTO `teacher`(`email`, `username`, `password`, `education`, `description`) VALUES ("hammad@example.com", "Hammad Ahmed",    "12345678", "MS in pop, From qwerty University", "I am a Professor at NUST, Islamabad, Pakistan. I teach Machine Learning to 2nd and 3rd Year Students.");

-- Populating "admin" Table
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin1@example.com', 'Admin 1', '12345678');
INSERT INTO `admin`(`email`, `username`, `password`) VALUES ('admin2@example.com', 'Admin 2', '12345678');

-- Populating "tutorial_catageory" Table
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Programming");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Arts");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Maths");
INSERT INTO `tutorial_categeory`(`name`) VALUES ("Biology");

-- Populating "tutorial" Table
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'Python',             'In this tutorial we will have a bried overview of Python');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com','JavaScript Features', 'In this tutorial we will have a bried overview of JavaScript Features');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'C++',                'In this tutorial we will have a bried overview of C++');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'Java Program Struture', 'In this tutorial we will have a bried overview of Java Program Structure' );
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (1, 'qaiser@example.com', 'C Data Types',          'In this tutorial we will have a bried overview of C Data Types');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'qaiser@example.com', 'Population and Sample Variance','Lets have fun with Ratios and Variance!!');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'qaiser@example.com', 'Quadratic Formula',  'The most important formula you need to know');

INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'tofeeq@example.com', 'Complex Numbers', 'In this tutorial we will learn about Complex Numbers and iota');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'qaiser@example.com', 'History Calculus', 'Newton invented Calculus and we will learn how he did it!');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (2, 'tofeeq@example.com', 'Linear Algebra Vector Spaces', 'Lets have a look on why Linear Algebra is the best branch of Maths');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'tofeeq@example.com', 'Drawing', 'Lets have a look at Drawing' );
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'tofeeq@example.com', 'Conceptual art', 'What is Conceptual Art?');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'tofeeq@example.com', 'Ceramics', 'How to make realistic looking Ceremic Sculptures');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'tofeeq@example.com', 'Painting', 'All you need to know about Painting');

INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (3, 'hammad@example.com', 'How to get started with Photography', 'In this tutorial we will learn about the basics of Photography');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'What are the parts of Speech?', 'In this tutorial we will look at all 8 Parts of Speech');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'How to use the Past Perfect Tense', 'Lets Learn about Past Perfect Tense');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'What are Gerunds', 'Gerunds are an important part of English Grammer, in this tutorial we will get familiarized with them' );
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'How to improve your Vocabulary', 'In this tutorial we will look on different techniques to make your vocab better');
INSERT INTO `tutorial`(`category_id`, `instructor`, `title`, `description`) VALUES (4, 'hammad@example.com', 'How to Change Direct Sentences to Indirect Sentences', 'Direct and Indirect Sentences');

-- Populating "paragraph" Table
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1, 'History', 'Python was conceived in the late 1980s by Guido van Rossum at Centrum Wiskunde & Informatica (CWI) in the Netherlands as a successor to ABC programming language, which was inspired by SETL, capable of exception handling and interfacing with the Amoeba operating system. Its implementation began in December 1989. Van Rossum shouldered sole responsibility for the project, as the lead developer, until 12 July 2018, when he announced his "permanent vacation" from his responsibilities as Pythons Benevolent Dictator For Life, a title the Python community bestowed upon him to reflect his long-term commitment as the projects chief decision-maker. He now shares his leadership as a member of a five-person steering council. In January 2019, active Python core developers elected Brett Cannon, Nick Coghlan, Barry Warsaw, Carol Willing and Van Rossum to a five-member "Steering Council" to lead the project. Guido van Rossum has since then withdrawn his nomination for the 2020 Steering council.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1, 'Indentation',  'Python uses whitespace indentation, rather than curly brackets or keywords, to delimit blocks. An increase in indentation comes after certain statements; a decrease in indentation signifies the end of the current block. Thus, the programs visual structure accurately represents the programs semantic structure. This feature is sometimes termed the off-side rule, which some other languages share, but in most languages indentation doesnt have any semantic meaning.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (1, 'Methods', 'Methods on objects are functions attached to the objects class; the syntax instance.method(argument) is, for normal methods and functions, syntactic sugar for Class.method(instance, argument). Python methods have an explicit self parameter to access instance data, in contrast to the implicit self (or this) in some other object-oriented programming languages (e.g., C++, Java, Objective-C, or Ruby).');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (2, 'Imperative and Structured', 'JavaScript supports much of the structured programming syntax from C (e.g., if statements, while loops, switch statements, do while loops, etc.). One partial exception is scoping: JavaScript originally had only function scoping with var. ECMAScript 2015 added keywords let and const for block scoping, meaning JavaScript now has both function and block scoping. Like C, JavaScript makes a distinction between expressions and statements. One syntactic difference from C is automatic semicolon insertion, which allows the semicolons that would normally terminate statements to be omitted.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (2, 'Functional', 'A function is first-class; a function is considered to be an object. As such, a function may have properties and methods, such as .call() and .bind(). A nested function is a function defined within another function. It is created each time the outer function is invoked. In addition, each nested function forms a lexical closure: The lexical scope of the outer function (including any constant, local variable, or argument value) becomes part of the internal state of each inner function object, even after execution of the outer function concludes. JavaScript also supports anonymous functions.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (3, 'C++ Core Guidelines', 'The C++ Core Guidelines are an initiative led by Bjarne Stroustrup, the inventor of C++, and Herb Sutter, the convener and chair of the C++ ISO Working Group, to help programmers write Modern C++ by using best practices for the language standards C++14 and newer, and to help developers of compilers and static checking tools to create rules for catching bad programming practices.\nThe main aim is to efficiently and consistently write type and resource safe C++.\nThe Core Guidelines were announced in the opening keynote at CPPCon 2015.\nThe Guidelines are accompanied by the Guideline Support Library (GSL), a header only library of types and functions to implement the Core Guidelines and static checker tools for enforcing Guideline rules');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (3, 'Compatibility', 'To give compiler vendors greater freedom, the C++ standards committee decided not to dictate the implementation of name mangling, exception handling, and other implementation-specific features. The downside of this decision is that object code produced by different compilers is expected to be incompatible. There were, however, attempts to standardize compilers for particular machines or operating systems (for example C++ ABI), though they seem to be largely abandoned now.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (3, 'Criticism', 'Despite its widespread adoption, some notable programmers have criticized the C++ language, including Linus Torvalds, Richard Stallman, Joshua Bloch, Ken Thompson, and Donald Knuth.\nOne of the most often criticised points of C++ is its perceived complexity as a language, with the criticism that a large number of non-orthogonal features in practice necessitates restricting code to subset of C++, thus eschewing the readability benefits of common style and idioms. As expressed by Joshua Bloch:\nI think C++ was pushed well beyond its complexity threshold, and yet there are a lot of people programming it. But what you do is you force people to subset it. So almost every shop that I know of that uses C++ says, "Yes, we are using C++ but we are not doing multiple-implementation inheritance and we are not using operator overloading." There are just a bunch of features that you are not going to use because the complexity of the resulting code is too high. And I do not think it is good when you have to start doing that. You lose this programmer portability where everyone can read everyone elses code, which I think is such a good thing.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (4, '"main" Method', 'Every Java application must have an entry point. This is true of both graphical interface applications and console applications. The entry point is the main method. There can be more than one class with a main method, but the main class is always defined externally (for example, in a manifest file). The method must be static and is passed command-line arguments as an array of strings. Unlike C++ or C#, it never returns a value and must return void.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (4, 'Packages', 'Packages are a part of a class name and they are used to group and/or distinguish named entities from other ones. Another purpose of packages is to govern code access together with access modifiers. For example, java.io.InputStream is a fully qualified class name for the class InputStream which is located in the package java.io. A package is declared at the start of the file with the package declaration');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (5, 'Pointers', 'C supports the use of pointers, a type of reference that records the address or location of an object or function in memory. Pointers can be dereferenced to access data stored at the address pointed to, or to invoke a pointed-to function. Pointers can be manipulated using assignment or pointer arithmetic. The run-time representation of a pointer value is typically a raw memory address (perhaps augmented by an offset-within-word field), but since a pointers type includes the type of the thing pointed to, expressions including pointers can be type-checked at compile time. Pointer arithmetic is automatically scaled by the size of the pointed-to data type. Pointers are used for many purposes in C. Text strings are commonly manipulated using pointers into arrays of characters. Dynamic memory allocation is performed using pointers. Many data types, such as trees, are commonly implemented as dynamically allocated struct objects linked together using pointers. Pointers to functions are useful for passing functions as arguments to higher-order functions (such as qsort or bsearch) or as callbacks to be invoked by event handlers');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (5, 'Arrays', 'Array types in C are traditionally of a fixed, static size specified at compile time. (The more recent C99 standard also allows a form of variable-length arrays.) However, it is also possible to allocate a block of memory (of arbitrary size) at run-time, using the standard librarys malloc function, and treat it as an array. Cs unification of arrays and pointers means that declared arrays and these dynamically allocated simulated arrays are virtually interchangeable. Since arrays are always accessed (in effect) via pointers, array accesses are typically not checked against the underlying array size, although some compilers may provide bounds checking as an option.[33][34] Array bounds violations are therefore possible and rather common in carelessly written code, and can lead to various repercussions, including illegal memory accesses, corruption of data, buffer overruns, and run-time exceptions. If bounds checking is desired, it must be done manually.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (6, 'Population Variance', 'Real-world observations such as the measurements of yesterdays rain throughout the day typically cannot be complete sets of all possible observations that could be made. As such, the variance calculated from the finite set will in general not match the variance that would have been calculated from the full population of possible observations. This means that one estimates the mean and variance that would have been calculated from an omniscient set of observations by using an estimator equation. The estimator is a function of the sample of n observations drawn without observational bias from the whole population of potential observations. In this example that sample would be the set of actual measurements of yesterdays rainfall from available rain gauges within the geography of interest.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (6, 'Sample Variance' , 'In many practical situations, the true variance of a population is not known a priori and must be computed somehow. When dealing with extremely large populations, it is not possible to count every object in the population, so the computation must be performed on a sample of the population.[9] Sample variance can also be applied to the estimation of the variance of a continuous distribution from a sample of that distribution.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (7, 'Historical Development', 'The earliest methods for solving quadratic equations were geometric. Babylonian cuneiform tablets contain problems reducible to solving quadratic equations. The Egyptian Berlin Papyrus, dating back to the Middle Kingdom (2050 BC to 1650 BC), contains the solution to a two-term quadratic equation. The Greek mathematician Euclid (circa 300 BC) used geometric methods to solve quadratic equations in Book 2 of his Elements, an influential mathematical treatise. Rules for quadratic equations appear in the Chinese The Nine Chapters on the Mathematical Art circa 200 BC. In his work Arithmetica, the Greek mathematician Diophantus (circa 250 AD) solved quadratic equations with a method more recognizably algebraic than the geometric algebra of Euclid. His solution gives only one root, even when both roots are positive. The Indian mathematician Brahmagupta (597 - 668 AD) explicitly described the quadratic formula in his treatise Brahmasphutasiddhanta published in 628 AD, but written in words instead of symbols. His solution of the quadratic equation ax2 + bx = c was as follows: "To the absolute number multiplied by four times the [coefficient of the] square, add the square of the [coefficient of the] middle term; the square root of the same, less the [coefficient of the] middle term, being divided by twice the [coefficient of the] square is the value."');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (8, 'Notation', 'A real number a can be regarded as a complex number a + 0i, whose imaginary part is 0. A purely imaginary number bi is a complex number 0 + bi, whose real part is zero. As with polynomials, it is common to write a for a + 0i and bi for 0 + bi. Moreover, when the imaginary part is negative, that is, b = -|b| < 0, it is common to write a - |b|i instead of a + (-|b|)i; for example, for b = -4, 3 - 4i can be written instead of 3 + (-4)i. Since the multiplication of the indeterminate i and a real is commutative in polynomials with real coefficients, the polynomial a + bi may be written as a + ib. This is often expedient for imaginary parts denoted by expressions, for example, when b is a radical');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (8, 'Definition', 'A complex number is a number of the form a + bi, where a and b are real numbers, and i is an indeterminate satisfying i2 = -1. For example, 2 + 3i is a complex number. This way, a complex number is defined as a polynomial with real coefficients in the single indeterminate i, for which the relation i2 + 1 = 0 is imposed. Based on this definition, complex numbers can be added and multiplied, using the addition and multiplication for polynomials. The relation i2 + 1 = 0 induces the equalities i4k = 1, i4k+1 = i, i4k+2 = -1, and i4k+3 = -i, which hold for all integers k; these allow the reduction of any polynomial that results from the addition and multiplication of complex numbers to a linear polynomial in i, again of the form a + bi with real coefficients a, b. The real number a is called the real part of the complex number a + bi; the real number b is called its imaginary part. To emphasize, the imaginary part does not include a factor i; that is, the imaginary part is b, not bi. Formally, the complex numbers are defined as the quotient ring of the polynomial ring in the indeterminate i, by the ideal generated by the polynomial i2 + 1');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (9, 'Ancient', 'The ancient period introduced some of the ideas that led to integral calculus, but does not seem to have developed these ideas in a rigorous and systematic way. Calculations of volumes and areas, one goal of integral calculus, can be found in the Egyptian Moscow papyrus (c. 1820 BC), but the formulas are only given for concrete numbers, some are only approximately true, and they are not derived by deductive reasoning. Babylonians may have discovered the trapezoidal rule while doing astronomical observations of Jupiter. From the age of Greek mathematics, Eudoxus (c. 408 - 355 BC) used the method of exhaustion, which foreshadows the concept of the limit, to calculate areas and volumes, while Archimedes (c. 287 - 212 BC) developed this idea further, inventing heuristics which resemble the methods of integral calculus.[4] Greek mathematicians are also credited with a significant use of infinitesimals. Democritus is the first person recorded to consider seriously the division of objects into an infinite number of cross-sections, but his inability to rationalize discrete cross-sections with a cones smooth slope prevented him from accepting the idea. At approximately the same time, Zeno of Elea discredited infinitesimals further by his articulation of the paradoxes which they create.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (9, 'Medieval', 'In the Islamic Middle East, the 11th-century Arab mathematician Ibn al-Haytham (Alhazen) derived a formula for the sum of fourth powers. He used the results to carry out what would now be called an integration, where the formulas for the sums of integral squares and fourth powers allowed him to calculate the volume of a paraboloid. In the 12th century, the Persian mathematician Sharaf al-Din al-Tusi discovered the derivative of cubic polynomials. His Treatise on Equations developed concepts related to differential calculus, such as the derivative function and the maxima and minima of curves, in order to solve cubic equations which may not have positive solutions. Some ideas on calculus later appeared in Indian mathematics, at the Kerala school of astronomy and mathematics. Madhava of Sangamagrama in the 14th century, and later mathematicians of the Kerala school, stated components of calculus such as the Taylor series and infinite series approximations. However, they were not able to combine many differing ideas under the two unifying themes of the derivative and the integral, show the connection between the two, and turn calculus into the powerful problem-solving tool we have today');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (10, 'Linear Maps', 'A bijective linear map between two vector spaces (that is, every vector from the second space is associated with exactly one in the first) is an isomorphism. Because an isomorphism preserves linear structure, two isomorphic vector spaces are "essentially the same" from the linear algebra point of view, in the sense that they cannot be distinguished by using vector space properties. An essential question in linear algebra is testing whether a linear map is an isomorphism or not, and, if it is not an isomorphism, finding its range (or image) and the set of elements that are mapped to the zero vector, called the kernel of the map. All these questions can be solved by using Gaussian elimination or some variant of this algorithm.');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (10, 'Subspaces, span, and basis', 'The study of those subsets of vector spaces that are in themselves vector spaces under the induced operations is fundamental, similarly as for many mathematical structures. These subsets are called linear subspaces. More precisely, a linear subspace of a vector space V over a field F is a subset W of V such that u + v and au are in W, for every u, v in W, and every a in F. (These conditions suffice for implying that W is a vector space.)');
INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (10, 'Linear Systems', 'A finite set of linear equations in a finite set of variables, for example, x1,x2, ... xn or x,y, ... z is called a system of linear equations or a linear system. Systems of linear equations form a fundamental part of linear algebra. Historically, linear algebra and matrix theory has been developed for solving such systems. In the modern presentation of linear algebra through vector spaces and matrices, many problems may be interpreted in terms of linear systems.');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (11, 'Introduction', 'Drawing is a means of making an image, using any of a wide variety of tools and techniques. It generally involves making marks on a surface by applying pressure from a tool, or moving a tool across a surface. Common tools are graphite pencils, pen and ink, inked brushes, wax colour pencils, crayons, charcoals, pastels, and markers. Digital tools which can simulate the effects of these are also used. The main techniques used in drawing are line drawing, hatching, crosshatching, random hatching, scribbling, stippling, and blending. An artist who excels in drawing is referred to as a drafter, draftswoman, or draughtsman. Drawing can be used to create art used in cultural industries such as illustrations, comics and animation. Comics are often called the "ninth art" (le neuvieme art) in Francophone scholarship, adding to the traditional "Seven Arts".');

INSERT INTO `paragraph`(`tutorial_id`, `heading`, `content`) VALUES (12, 'Introduction', 'Conceptual art is art in which the concept(s) or idea(s) involved in the work takes precedence over traditional aesthetic and material concerns. The inception of the term in the 1960s referred to a strict and focused practice of idea-based art that often defied traditional visual criteria associated with the visual arts in its presentation as text. Through its association with the Young British Artists and the Turner Prize during the 1990s, its popular usage, particularly in the United Kingdom, developed as a synonym for all contemporary art that does not practise the traditional skills of painting and sculpture.');




-- Populating "quiz" Table


-- Populating "question" Table


-- Populating "student_tutorial_bridge" Table


--Populating "student_quiz_bridge"Table



