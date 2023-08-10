<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" type="image/x-icon" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Aung Myin User Guide</title>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

    body {
      font-family: "Poppins", sans-serif;
    }

    .navbar-brand {
      font-size: 1.2em;
      font-weight: bold;
    }

    .navbar .navbar-nav .nav-link {
      color: #fff;
    }

    .dropdown .dropdown-item.active,
    .dropdown .dropdown-item:active {
      background-color: #003049 !important;
    }

    button[aria-expanded="false"]>.close {
      display: none;
    }

    button[aria-expanded="true"]>.open {
      display: none;
    }

    .tab-content {
      margin-top: 50px;
    }

    @media screen and (min-width: 992px) {

      .navbar .container-fluid,
      .navbar-expand-lg .navbar-collapse,
      .navbar-expand-lg .navbar-nav {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar {
        width: 22%;
        height: 100vh;
        align-items: flex-start;
      }

      .navbar-brand {
        margin-left: 0.5rem;
        font-size: 1.2em;
        font-weight: bold;
      }

      .tab-content {
        margin-top: 0;
      }
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #003049">
        <div class="container-fluid">
          <a class="navbar-brand d-flex justify-content-center align-items-center" style="gap: 8px" href="">
            <img src="{{ asset('images/web-photos/aung-myin.png') }}" alt="Logo" width="30" class="img-fluid" />
            <span class="d-none d-md-block">Aung Myin Docs</span>
          </a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars open"></i>
            <i class="fa-solid fa-xmark close"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav me-auto mb-2 mb-lg-0 mt-3 mt-lg-5">
              <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#introduction"><i class="fa-solid fa-house"></i> Introduction</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#getting-started"><i class="fa-solid fa-flag"></i> Getting Started</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-location-dot"></i> Interface &
                  Navigation
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#home-panel"><i class="fa-solid fa-house-chimney"></i> Home</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#users-panel"><i class="fa-solid fa-user"></i> Users</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#patients-panel"><i class="fa-solid fa-clipboard-user"></i> Patients
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#dictionary-panel"><i class="fa-solid fa-book"></i> Dictionary</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#pharmacy-panel"><i class="fa-solid fa-pills"></i> Pharmacy</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#pos-panel"><i class="fa-solid fa-tv"></i> POS</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#procedure-panel"><i class="fa-solid fa-bed-pulse"></i> Procedure</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#setting-panel"><i class="fa-solid fa-gear"></i> Setting</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-user-gear"></i> Roles & Responsibility
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#admin"><i class="fa-solid fa-user-shield"></i> Admin</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#receptionist"><i class="fa-solid fa-bell-concierge"></i>
                      Receptionist</a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#doctor"><i class="fa-solid fa-user-doctor"></i> Doctor
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" data-bs-toggle="tab" href="#pharmacist"><i class="fa-solid fa-user-tie"></i> Pharmacist</a>
                  </li>
                  <!-- <li><hr class="dropdown-divider" /></li> -->
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#feedback"><i class="fa-solid fa-comment-dots"></i> Feedback</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#contact"><i class="fa-solid fa-envelope"></i> Contact and Support</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="col-lg-9 p-4" style="margin-left: auto">
        <div class="tab-content">
          <!-- Introduction -->
          <div class="tab-pane fade show active" id="introduction">
            <h2 class="mb-4">Introduction</h2>
            <p>
              Welcome to the user guide for Aung Myin, a comprehensive
              clinical management system designed to streamline patient
              management, facilitate medical procedures, and enhance the
              overall efficiency of healthcare facilities. This document
              provides detailed instructions on how to use the various
              features and functionalities of Aung Myin.
            </p>
            <h5>1.1 Overview of Aung Myin and its Purpose</h5>
            <p>
              Aung Myin is a web-based application that offers a wide range of
              tools and functionalities to support the management of
              healthcare clinics. It enables healthcare professionals to
              efficiently handle patient records, appointments, treatments,
              prescriptions, and more. Aung Myin aims to improve the overall
              quality of patient care by providing a centralized platform for
              managing clinical operations effectively.
            </p>
            <h5>1.2 Target Audience for the User Guide</h5>
            <p>
              This user guide is intended for healthcare professionals,
              including doctors, pharmacists, receptionists, and other clinic
              staff, who will be using Aung Myin to manage patient data and
              streamline clinical operations. It assumes a basic understanding
              of web-based applications and familiarity with general clinical
              management practices.
            </p>
            <h5>1.3 Important Notes or Prerequisites</h5>
            <p>
              Before using Aung Myin, please ensure the following
              prerequisites are met:
            </p>
            <ul>
              <li>
                Access to a computer with a modern web browser (Google Chrome,
                Mozilla Firefox, or Safari).
              </li>
              <li>
                Stable internet connection to access the Aung Myin web app.
              </li>
            </ul>
          </div>

          <!-- Getting Started -->
          <div class="tab-pane fade" id="getting-started">
            <h2 class="mb-4">Getting Started</h2>
            <h5>2.1 Accessing the Aung Myin Web App</h5>
            <p>To access the Aung Myin web app, follow these steps:</p>
            <ul>
              <li>Open a web browser on your computer.</li>
              <li>
                Enter the URL for the Aung Myin web app (e.g.,
                https://test.aungmyin.io/) in the address bar.
              </li>
              <li>
                Press Enter or click the Go button to navigate to the website.
              </li>
              <li>Aung Myin landing page will be displayed.</li>
            </ul>

            <h5>2.2 Landing Page Overview</h5>
            <p>
              Aung Myin landing page serves as the entry point to the
              application. It provides a brief overview of the system's
              features and benefits. From the landing page, you can navigate
              to the login or account creation page.
            </p>

            <h5>2.3 Creating an Account</h5>
            <p>To create an account in Aung Myin, follow these steps:</p>

            <ul>
              <li>On the landing page, click the "Get Started" button.</li>
              <li>Fill in your email address to verify your account.</li>
              <li>
                An email with an OTP (One-Time Password) code will be sent to
                the provided email address.
              </li>
              <li>
                Check your email inbox for the verification email from Aung
                Myin.
              </li>
              <li>Open the email and locate the OTP code.</li>
              <li>
                Return to the Aung Myin web app and enter the OTP code in the
                designated field.
              </li>
              <li>
                Click the "Verify" button to complete the verification
                process.
              </li>
              <li>
                Fill in the required information, such as your first name,
                last name, and contact details.
              </li>
              <li>Choose a secure password.</li>
              <li>
                Click the "Create Account" or "Sign Up" button to proceed.
              </li>
              <li>
                Upon successful verification, you will be redirected to the
                package selection page.
              </li>
            </ul>
            <h5>2.4 Package Selection</h5>
            <p>
              The Package Selection feature allows you to choose the
              appropriate package for your clinic's needs and complete the
              purchase. Here's what you need to know:
            </p>

            <ul>
              <li>
                Selecting the Suitable Package: Review the available packages
                and select the one that aligns with your clinic's
                requirements.
              </li>
              <li>
                Purchasing the Selected Package: Follow the provided
                instructions to purchase the selected package.
              </li>
              <li>
                Clinic Create: Enter your clinic name and create your clinic.
              </li>
            </ul>
            <h5>2.5 Understanding the User Interface and Navigation</h5>
            <p>
              Once you finished creating your clinic, you will be presented
              with the user interface. Familiarize yourself with the various
              sections, menus, and navigation options available. The user
              interface typically consists of a top navigation bar, a side
              menu, and a main content area. Use the navigation elements from
              the side menu to access different panels and functionalities of
              the application.
            </p>
          </div>

          <!-- Home Panel -->
          <div class="tab-pane fade" id="home-panel">
            <h2 class="mb-4">Home Panel</h2>
            <h5>3.1 Searching for Patients</h5>
            <p>
              In the Home panel, you can search for patients using their
              names, ages, or father names. Follow these steps to search for
              patients:
            </p>
            <ul>
              <li>
                Navigate to the Home panel using the side menu or any provided
                shortcuts.
              </li>
              <li>Locate the search bar or search field.</li>
              <li>Enter the patient's name, age, or father's name.</li>
              <li>
                The search results will be displayed, showing matching patient
                records.
              </li>
            </ul>
          </div>

          <!-- Users Panel -->
          <div class="tab-pane fade" id="users-panel">
            <h2 class="mb-4">Users Panel</h2>
            <h5>4.1 Adding Users to Your Clinic</h5>
            <p>
              To add users to your clinic, such as doctors, pharmacists,
              receptionists, and staff, follow these steps:
            </p>
            <ul>
              <li>Navigate to the User panel.</li>
              <li>Click the "Add new" button.</li>
              <li>
                Fill in the required user information, including name, contact
                details, and role.
              </li>
              <li>Assign appropriate permissions to the user.</li>
              <li>
                Click the "Submit" button to add the user to your clinic.
              </li>
            </ul>
            <h5>4.2 Managing User Roles and Permissions</h5>
            <p>
              As an administrator or authorized user, you can manage user
              roles and permissions in Aung Myin. Follow these steps to manage
              user roles:
            </p>
            <ul>
              <li>Navigate to the User panel.</li>
              <li>
                Locate the user whose role you want to manage and click the
                edit button.
              </li>
              <li>
                Select or deselect the appropriate roles or permissions for
                the user.
              </li>
              <li>Click the "Submit" button to save the changes.</li>
            </ul>
            <h5>4.3 Searching for Users and Associated Information</h5>
            <ul>
              <li>Navigate to the User panel.</li>
              <li>
                Use the search bar to enter the name, role type, or phone
                number you want to find.
              </li>
              <li>The system will display relevant users.</li>
            </ul>
          </div>

          <!-- Patients Panel -->
          <div class="tab-pane fade" id="patients-panel">
            <h2 class="mb-4">Patients Panel</h2>
            <p>
              The Patient Panel allows you to manage patient records and
              provide treatment to your patients. Follow the instructions
              below to perform tasks related to patient management:
            </p>
            <h5>5.1 Creating and Managing Patients</h5>
            <ul>
              <li>Navigate to the Patient Panel.</li>
              <li>Click on the "Add new" button.</li>
              <li>
                Enter the required patient information, such as name, contact
                details, disease, and drug allergy.
              </li>
              <li>Save the patient record to create a new patient.</li>
              <li>
                To manage existing patients, select the patient and use the
                "Edit" or "Delete" buttons.
              </li>
            </ul>
            <h5>5.2 Providing Treatment to Patients</h5>
            <ul>
              <li>Navigate to the Patient Panel.</li>
              <li>
                Locate the patient for whom you want to provide treatment.
              </li>
              <li>Select the patient and click on the treatment button.</li>
              <li>
                Follow the on-screen prompts to record the treatment details.
              </li>
              <li>
                Save the treatment information to associate it with the
                patient's record.
              </li>
            </ul>
          </div>

          <!-- Dictionary Panel -->
          <div class="tab-pane fade" id="dictionary-panel">
            <h2 class="mb-4">Dictionary Panel</h2>
            <p>
              The Dictionary Panel allows you to manage a medical dictionary
              and quickly reference medical terms. Follow the instructions
              below to utilize the dictionary functionality:
            </p>
            <h5>6.1 Creating and Managing a Medical Dictionary</h5>
            <ul>
              <li>Navigate to the Dictionary panel.</li>
              <li>Click on the "Add new" button to create a new term.</li>
              <li>
                Enter the term and its definition in the provided fields.
              </li>
              <li>Save the term to add it to the dictionary.</li>
              <li>
                To manage existing terms, select the term and use the "Edit"
                or "Delete" buttons.
              </li>
            </ul>
            <h5>
              6.2 Searching for Medical Terms and Associated Information
            </h5>
            <ul>
              <li>Navigate to the Dictionary panel.</li>
              <li>
                Use the search bar to enter the medical term you want to find.
              </li>
              <li>
                The system will display relevant terms and their definitions.
              </li>
            </ul>
          </div>

          <!-- Pharmacy Panel -->
          <div class="tab-pane fade" id="pharmacy-panel">
            <h2 class="mb-4">Pharmacy Panel</h2>
            <p>
              The Pharmacy Panel allows you to manage the list of medicines
              available in your clinic. Follow the instructions below to
              perform pharmacy-related tasks:
            </p>
            <h5>7.1 Creating and Managing the List of Medicines</h5>
            <ul>
              <li>Navigate to the Pharmacy Panel.</li>
              <li>Click on the "Add new" button.</li>
              <li>
                Enter the required details for the medicine, such as name,
                expiration date, and quantity.
              </li>
              <li>Save the medicine information to add it to the list.</li>
              <li>
                To manage existing medicines, select the medicine and use the
                "Edit" or "Delete" buttons.
              </li>
            </ul>
            <h5>7.2 Searching for Medicines and Associated Information</h5>
            <ul>
              <li>Navigate to the Pharmacy Panel.</li>
              <li>
                Use the search bar to enter the medicine name you want to
                find.
              </li>
              <li>The system will display relevant medicines.</li>
            </ul>
          </div>

          <!-- POS Panel -->
          <div class="tab-pane fade" id="pos-panel">
            <h2 class="mb-4">POS Panel</h2>
            <p>
              The POS Panel facilitates selling medicines to patients and
              managing the Point of Sale process. Follow the instructions
              below to utilize the features of the POS Panel:
            </p>
            <h5>8.1 Selling Medicines to Patients</h5>
            <ul>
              <li>Navigate to the POS Panel.</li>
              <li>Select the patient for whom you want to sell medicine.</li>
              <li>Choose the desired medicine from the available list.</li>
              <li>Save the medicine information to add it to the list.</li>
              <li>Enter the quantity of the medicine being sold.</li>
              <li>Confirm the sale.</li>
            </ul>
            <h5>8.2 Checking Invoice History and Printing Invoices</h5>
            <ul>
              <li>Navigate to the POS Panel.</li>
              <li>Access the invoice history section.</li>
              <li>
                Search for invoices by patient name, invoice code, or other
                relevant criteria.
              </li>
              <li>View information about past transactions.</li>
              <li>
                Locate the patient for whom you want to print an invoice.
              </li>
              <li>Choose the specific invoice to print.</li>
            </ul>
          </div>

          <!-- Procedure Panel -->
          <div class="tab-pane fade" id="procedure-panel">
            <h2 class="mb-4">Procedure Panel</h2>
            <p>
              The Procedure Panel allows you to manage medical procedures and
              investigations for patients. Follow the instructions below to
              perform tasks related to procedure management:
            </p>
            <h5>9.1 Managing Medical Procedures and Investigations</h5>
            <ul>
              <li>Navigate to the Procedure Panel.</li>
              <li>Click on the "Add new" button.</li>
              <li>
                Enter the details of the procedure or investigation, such as
                name, and price.
              </li>
              <li>Save the information to create a new record.</li>
              <li>
                To manage existing procedures, select the procedure and use
                the "Edit" or "Delete" buttons.
              </li>
            </ul>
          </div>

          <!-- Setting Panel -->
          <div class="tab-pane fade" id="setting-panel">
            <h2 class="mb-4">Setting Panel</h2>
            <p>
              The Setting Panel allows you to update your information and
              credentials. Follow the instructions below to perform tasks
              related to user settings:
            </p>
            <h5>10.1 Updating Information</h5>
            <ul>
              <li>Open the Setting Panel from the main menu.</li>
              <li>Modify your information as necessary.</li>
              <li>Save the changes to update your information.</li>
            </ul>
          </div>

          <!-- Admin Role -->
          <div class="tab-pane fade" id="admin">
            <h2 class="mb-4">Admin Role</h2>
            <h5>11.1 Admin Privileges and Responsibilities</h5>
            <ul>
              <li>
                Adding, Removing, and Editing Clinic Staff: Manage the
                clinic's staff members, including doctors, receptionists,
                pharmacists, and staff.
              </li>
              <li>
                Managing Patients: Add, edit, and remove patient records
                within the clinic.
              </li>
              <li>Managing Dictionary</li>
              <li>Managing Medicine</li>
              <li>Managing POS</li>
            </ul>
          </div>

          <!-- Receptionist Role -->
          <div class="tab-pane fade" id="receptionist">
            <h2 class="mb-4">Receptionist Role</h2>
            <p>
              The Receptionist Role feature provides receptionists with
              specific functionalities within the system. Here's what you can
              do:
            </p>
            <p>
              Logging in as a Receptionist: Access the system using your
              assigned receptionist credentials.
            </p>
            <h5>12.1 Receptionist Privileges and Responsibilities</h5>
            <ul>
              <li>
                CRUD Functionality for Patients: Create, read, update, and
                delete patient records as required.
              </li>
              <li>
                Managing the Waiting List: Keep track of patients' waiting
                status and make necessary updates.
              </li>
              <li>
                Assigning Patients to Doctors: Assign patients to doctors
                based on priority.
              </li>
            </ul>
          </div>

          <!-- Doctor Role -->
          <div class="tab-pane fade" id="doctor">
            <h2 class="mb-4">Doctor Role</h2>
            <p>
              The Doctor Role feature provides doctors with specific
              functionalities within the system. Here's what you can do:
            </p>
            <p>
              Logging in as a Doctor: Access the system using your assigned
              doctor credentials.
            </p>

            <h5>13.1 Doctor Privileges and Responsibilities</h5>
            <ul>
              <li>
                Receiving Patient Assignments: Receive notifications and
                assignments for patients requiring medical attention.
              </li>
              <li>
                Notifying and Treating Assigned Patients: Communicate with
                assigned patients, provide necessary treatments, and update
                their records.
              </li>
              <li>
                Recording Patient Vital Signs and Assigning Medication: Record
                vital signs and prescribe medications to assigned patients.
              </li>
              <li>
                Viewing Patient Visit Records: Access and review patient visit
                records, including past treatments and procedures.
              </li>
            </ul>
          </div>

          <!-- Pharmacist Role -->
          <div class="tab-pane fade" id="pharmacist">
            <h2 class="mb-4">Pharmacist Role</h2>
            <p>
              The Pharmacist Role feature provides pharmacists with specific
              functionalities within the system. Here's what you can do:
            </p>
            <p>
              Logging in as a Pharmacist: Access the system using your
              assigned pharmacist credentials.
            </p>
            <h5>14.1 Pharmacist Privileges and Responsibilities</h5>
            <ul>
              <li>
                Receiving Notifications for Completed Treatments: Get notified
                when treatments are completed for patients.
              </li>
              <li>
                Selling Prescribed Medication through the POS Panel: Process sales of prescribed medications to patients using the POS panel.
              </li>
              <li>
                Printing Invoices for Patients: Print invoices including
                medicine costs, doctor fees, and follow-up dates.
              </li>
            </ul>
          </div>

          <!-- Feedback -->
          <div class="tab-pane fade" id="feedback">
            <h2 class="mb-4">Feedback</h2>
            <p>
              The feedback section provides a form to send your suggestions,
              comments, or feedbacks for this system.
            </p>
          </div>

          <!-- Contact and Support -->
          <div class="tab-pane fade" id="contact">
            <h2 class="mb-4">Contact and Support</h2>
            <p>
              If you encounter any issues or need further assistance with the
              Aung Myin Clinical Management System, refer to the provided
              contact information to get in touch with the support team. They
              will be ready to assist you and address any concerns you may have.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>