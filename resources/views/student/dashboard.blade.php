@extends('layouts.app')

@section('content')
<div class="main-container">
    <!-- Scrollable sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2>Instructors</h2>
            <button id="toggle-sidebar" class="toggle-sidebar-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        
        <!-- Dashboard button -->
        <div class="dashboard-btn-container">
            <button class="dashboard-btn" id="dashboard-btn">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </button>
        </div>
        
        <div class="sidebar-tabs">
            <button class="tab-btn active" data-tab="all">All</button>
            <button class="tab-btn" data-tab="completed">Completed</button>
            <button class="tab-btn" data-tab="to-evaluate">To Evaluate</button>
        </div>
        
        <div class="instructor-list">
            <!-- If you have no instructor data yet, you can use static content -->
            <div class="instructor-item" data-instructor-id="1">
                <div class="instructor-avatar">J</div>
                <div class="instructor-info">
                    <h3>Dr. James Wilson</h3>
                    <p><strong>Subject:</strong> Mobile Development</p>
                    <p><strong>Course:</strong> IT 105L</p>
                    <p><strong>Semester:</strong> Spring</p>
                    <p><strong>Year:</strong> 2025</p>
                </div>
            </div>
            
            <div class="instructor-item" data-instructor-id="2">
                <div class="instructor-avatar">M</div>
                <div class="instructor-info">
                    <h3>Prof. Maria Chen</h3>
                    <p><strong>Subject:</strong> Quantitative Methods</p>
                    <p><strong>Course:</strong> 2/SY 24-25</p>
                    <p><strong>Semester:</strong> Spring</p>
                    <p><strong>Year:</strong> 2025</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main content area -->
    <div class="content" id="content-area">
        <!-- Dashboard view (default) -->
        <div id="dashboard-view">
            <div class="welcome-card">
                <h1>Welcome to Course Feedback</h1>
                <p>Your voice matters! Help us improve teaching and learning by providing your 
                   valuable feedback on your instructors and courses.</p>
            </div>
            
            <div class="stats-container">
                <div class="stat-card">
                    <h3>Total Instructors</h3>
                    <div class="stat-number">2</div>
                </div>
                <div class="stat-card">
                    <h3>Completed</h3>
                    <div class="stat-number">0</div>
                </div>
                <div class="stat-card">
                    <h3>Pending</h3>
                    <div class="stat-number">2</div>
                </div>
            </div>
            
            <div class="info-card">
                <p>Select an instructor from the sidebar to begin providing feedback.</p>
            </div>
        </div>
        
        <!-- Evaluation form (hidden by default) -->
        <div id="evaluation-form" class="hidden">
            <div class="back-to-dashboard">
                <button id="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </button>
            </div>
            <div class="evaluation-container">
                <h2 id="instructor-name"></h2>
                <div id="instructor-details"></div>
                
                <form id="feedback-form" method="POST" action="{{ route('feedback.store') }}">
                    @csrf
                    <input type="hidden" name="instructor_id" id="instructor_id_input">
                    
                    <!-- Sample evaluation questions -->
                    <div id="evaluation-questions">
                        <div class="question-group">
                            <h3>Teaching Effectiveness</h3>
                            
                            <div class="question-item">
                                <label>1. The instructor explains concepts clearly.</label>
                                <div class="rating">
                                    <input type="radio" name="q1" value="1" required> 1
                                    <input type="radio" name="q1" value="2"> 2
                                    <input type="radio" name="q1" value="3"> 3
                                    <input type="radio" name="q1" value="4"> 4
                                    <input type="radio" name="q1" value="5"> 5
                                </div>
                            </div>
                            
                            <!-- More questions... -->
                        </div>
                        
                        <div class="question-group">
                            <h3>Additional Comments</h3>
                            
                            <div class="question-item">
                                <label>Please provide any additional feedback:</label>
                                <textarea name="comments" rows="4" class="w-full"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group mt-4">
                        <button type="submit" class="submit-btn">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-sidebar');
        const dashboardBtn = document.getElementById('dashboard-btn');
        const dashboardView = document.getElementById('dashboard-view');
        const evaluationForm = document.getElementById('evaluation-form');
        const backBtn = document.getElementById('back-btn');
        const tabButtons = document.querySelectorAll('.tab-btn');
        const instructorItems = document.querySelectorAll('.instructor-item');
        
        // Toggle sidebar
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            
            // Change icon direction
            const icon = this.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');
            }
        });
        
        // Tab switching functionality
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                tabButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Filter instructors based on tab
                const tabType = this.dataset.tab;
                filterInstructors(tabType);
            });
        });
        
        // Dashboard button functionality
        dashboardBtn.addEventListener('click', function() {
            showDashboard();
        });
        
        // Back button functionality
        backBtn.addEventListener('click', function() {
            showDashboard();
        });
        
        // Instructor selection functionality
        instructorItems.forEach(item => {
            item.addEventListener('click', function() {
                const instructorId = this.dataset.instructorId;
                loadEvaluationForm(instructorId);
            });
        });
        
        // Function to filter instructors
        function filterInstructors(tabType) {
            instructorItems.forEach(item => {
                if (tabType === 'all') {
                    item.style.display = 'flex';
                } else if (tabType === 'completed') {
                    // For demo purposes, let's assume none are completed
                    item.style.display = 'none';
                } else if (tabType === 'to-evaluate') {
                    // For demo purposes, let's assume all are to be evaluated
                    item.style.display = 'flex';
                }
            });
        }
        
        // Function to show dashboard and hide evaluation form
        function showDashboard() {
            dashboardView.classList.remove('hidden');
            evaluationForm.classList.add('hidden');
            
            // Remove selected class from all instructor items
            instructorItems.forEach(item => {
                item.classList.remove('selected');
            });
        }
        
        // Function to load evaluation form for an instructor
        function loadEvaluationForm(instructorId) {
            // Add selected class to clicked instructor
            instructorItems.forEach(item => {
                if (item.dataset.instructorId === instructorId) {
                    item.classList.add('selected');
                } else {
                    item.classList.remove('selected');
                }
            });
            
            // Hide dashboard and show evaluation form
            dashboardView.classList.add('hidden');
            evaluationForm.classList.remove('hidden');
            
            // Set instructor ID in form
            document.getElementById('instructor_id_input').value = instructorId;
            
            // Get instructor details
            const instructorItem = document.querySelector(`.instructor-item[data-instructor-id="${instructorId}"]`);
            const instructorName = instructorItem.querySelector('h3').textContent;
            const instructorDetails = instructorItem.querySelector('.instructor-info').innerHTML;
            
            // Set instructor details in evaluation form
            document.getElementById('instructor-name').textContent = instructorName;
            document.getElementById('instructor-details').innerHTML = instructorDetails;
        }
    });
</script>
@endsection