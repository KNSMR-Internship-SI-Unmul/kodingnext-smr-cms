export const roleManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,

    showRoleModal: config.hasErrors,
    showDeleteModal: false,
    editMode: config.oldRoleId ? true : false,
    actionUrl: config.oldRoleId ? `/roles/${config.oldRoleId}` : config.storeRoute,

    roleData: {
        id: config.oldRoleId || '',
        name: config.oldName || '',
    },

    openEditModal(role) {
        this.editMode = true;
        this.roleData = { ...role };
        this.actionUrl = `/employees/roles/${role.id}`;
        this.showRoleModal = true;
    },

    openDeleteModal(roleId) {
        this.actionUrl = `/employees/roles/${roleId}`;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (config.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showRoleModal = false;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = config.storeRoute;
        this.roleData = { id: '', name: '' };
        this.showRoleModal = true;
    }
});

export const employeeManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,

    showEmployeeModal: config.hasErrors,
    showDeleteModal: false,
    editMode: config.oldEmployeeId ? true : false,
    actionUrl: config.oldEmployeeId ? `/employees/${config.oldEmployeeId}` : config.storeRoute,
    imagePreview: config.oldImage ? `/storage/${config.oldImage}` : null,

    employeeData: {
        id: config.oldEmployeeId || '',
        name: config.oldName || '',
        email: config.oldEmail || '',
        phone_number: config.oldPhoneNumber || '',
        profile_picture: config.oldProfilePicture || '',
        hired_date: config.oldHiredDate || '',
        role_id: config.oldRoleId || '',
        password: '',
    },

    openEditModal(employee) {
        this.editMode = true;
        let formattedDate = employee.hired_date ? String(employee.hired_date).substring(0, 10) : '';
        this.employeeData = { ...employee, profile_picture: '', hired_date: formattedDate, profile_picture: employee.profile_picture };
        this.actionUrl = `/employees/${employee.id}`;
        this.imagePreview = employee.profile_picture ? '/storage/' + employee.profile_picture : null;
        this.showEmployeeModal = true;
    },

    openDeleteModal(employeeId) {
        this.actionUrl = `/employees/${employeeId}`;
        this.showDeleteModal = true;
    },

    init() {
        if (this.employeeData.id) {
            this.actionUrl = `/employees/${this.employeeData.id}`;
        }
    },

    closeEditModal() {
        if (config.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showEmployeeModal = false;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = config.storeRoute;
        this.employeeData = { id: '', name: '', email: '', phone_number: '', profile_picture: '', hired_date: '', role_id: '' };
        this.imagePreview = null;
        this.showEmployeeModal = true;
    }
});

export const promotionManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,
    bulkDestroyRoute: config.bulkDestroyRoute,
    promotionIds: config.promotionIds,
    promotionCount: config.promotionCount,

    showPromotionModal: config.hasErrors,
    showDeleteModal: false,
    showDetailModal: false,
    deleteMode: 'single',
    editMode: config.oldPromotionId ? true : false,
    actionUrl: config.oldPromotionId ? `/promotions/${config.oldPromotionId}` : config.storeRoute,
    imagePreview: config.oldImage ? `/storage/${config.oldImage}` : null,

    promotionData: {
        id: config.oldPromotionId || '',
        title: config.oldTitle || '',
        description: config.oldDescription || '',
        image: config.oldImage || '',
        start_date: config.oldStartDate || '',  
        end_date: config.oldEndDate || '',
        formatted_start: '',
        formatted_end: ''
    },

    selectedPromotions: [],
    get allSelected() {
        return this.selectedPromotions.length === this.promotionCount && this.promotionCount > 0;
    },
    toggleAll() {
        if (this.allSelected) {
            this.selectedPromotions = [];
        } else {
            this.selectedPromotions = [...this.promotionIds]; 
        }
    },

    openEditModal(promotion) {
        this.editMode = true;
        let startDate = promotion.start_date ? String(promotion.start_date).substring(0, 10) : '';
        let endDate = promotion.end_date ? String(promotion.end_date).substring(0, 10) : '';
        this.promotionData = { ...promotion, start_date: startDate, end_date: endDate, image: promotion.image };
        this.actionUrl = `/promotions/${promotion.id}`;
        this.imagePreview = promotion.image ? `/storage/${promotion.image}` : null;
        this.showPromotionModal = true;
    },

    openDeleteModal(promotionId) {
        this.deleteMode = 'single';
        this.actionUrl = `/promotions/${promotionId}`;
        this.showDeleteModal = true;
    },

    openBulkDeleteModal() {
        this.deleteMode = 'bulk';
        this.actionUrl = this.bulkDestroyRoute;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (this.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showPromotionModal = false;
            this.imagePreview = null;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = this.storeRoute;
        this.promotionData = { id: '', title: '', description: '', image: '', start_date: '', end_date: '' };
        this.imagePreview = null;
        this.showPromotionModal = true;
    },

    openDetailModal(promotion) {
        let options = { day: 'numeric', month: 'long', year: 'numeric' };
        let formattedStart = promotion.start_date ? new Date(promotion.start_date).toLocaleDateString('en-GB', options) : '-';
        let formattedEnd = promotion.end_date ? new Date(promotion.end_date).toLocaleDateString('en-GB', options) : '-';
        
        this.promotionData = { 
            ...promotion, 
            formatted_start: formattedStart, 
            formatted_end: formattedEnd 
        };
        this.showDetailModal = true;
    }
});

export const eventManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,
    bulkDestroyRoute: config.bulkDestroyRoute,
    eventIds: config.eventIds,
    eventCount: config.eventCount,

    showEventModal: config.hasErrors,
    showDeleteModal: false,
    showDetailModal: false,
    deleteMode: 'single',
    editMode: config.oldEventId ? true : false,
    actionUrl: config.oldEventId ? `/events/${config.oldEventId}` : config.storeRoute,
    imagePreview: config.oldImage ? `/storage/${config.oldImage}` : null,

    eventData: {
        id: config.oldEventId || '',
        name: config.oldName || '',
        event_date: config.oldEventDate || '',  
        description: config.oldDescription || '',
        image: config.oldImage || '',
    },

    selectedEvents: [],
    get allSelected() {
        return this.selectedEvents.length === this.eventCount && this.eventCount > 0;
    },
    toggleAll() {
        if (this.allSelected) {
            this.selectedEvents = [];
        } else {
            this.selectedEvents = [...this.eventIds]; 
        }
    },

    openEditModal(event) {
        this.editMode = true;
        let eventDate = event.event_date ? String(event.event_date).substring(0, 10) : '';
        this.eventData = { ...event, event_date: eventDate, image: event.image };
        this.actionUrl = `/events/${event.id}`;
        this.imagePreview = event.image ? `/storage/${event.image}` : null;
        this.showEventModal = true;
    },

    openDeleteModal(eventId) {
        this.deleteMode = 'single';
        this.actionUrl = `/events/${eventId}`;
        this.showDeleteModal = true;
    },

    openBulkDeleteModal() {
        this.deleteMode = 'bulk';
        this.actionUrl = this.bulkDestroyRoute;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (this.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showEventModal = false;
            this.imagePreview = null;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = this.storeRoute;
        this.eventData = { id: '', name: '', event_date: '', description: '', image: '' };
        this.imagePreview = null;
        this.showEventModal = true;
    },

    openDetailModal(event) {
        let options = { day: 'numeric', month: 'long', year: 'numeric' };
        let formattedEventDate = event.event_date ? new Date(event.event_date).toLocaleDateString('en-GB', options) : '-';
        this.eventData = { 
            ...event, 
            formatted_event_date: formattedEventDate 
        };
        this.showDetailModal = true;
    }
});

export const courseTypeManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,

    showCourseModal: config.hasErrors,
    showDeleteModal: false,
    editMode: config.oldCourseTypeId ? true : false,
    actionUrl: config.oldCourseTypeId ? `/dashboard/courses/${config.oldCourseTypeId}` : config.storeRoute,
    imagePreview: config.oldImage ? `/storage/${config.oldImage}` : null,

    courseTypeData: {
        id: config.oldCourseTypeId || '',
        name: config.oldName || '',
        description: config.oldDescription || '',
        image: config.oldImage || '',
    },

    openEditModal(courseType) {
        this.editMode = true;
        this.courseTypeData = { ...courseType, image: courseType.image };
        this.actionUrl = `/dashboard/courses/${courseType.id}`;
        this.imagePreview = courseType.image ? `/storage/${courseType.image}` : null;
        this.showCourseModal = true;
    },

    openDeleteModal(courseTypeId) {
        this.actionUrl = `/dashboard/courses/${courseTypeId}`;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (config.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showCourseModal = false;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = config.storeRoute;
        this.courseTypeData = { id: '', name: '', description: '', image: '' };
        this.imagePreview = null;
        this.showCourseModal = true;
    },

    openDetailModal(courseType) {
        this.courseTypeData = { ...courseType };
        this.showDetailModal = true;
    }
});

export const moduleManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,
    juniorKoderId: config.juniorKoderId,
    
    showModuleModal: config.hasErrors,
    showDeleteModal: false,
    editMode: config.oldModuleId ? true : false,
    actionUrl: config.oldModuleId ? `/modules/${config.oldModuleId}` : config.storeRoute,
    imagePreview: config.oldImage ? `/storage/${config.oldImage}` : null,

    moduleData: {
        id: config.oldModuleId || '',
        name: config.oldName || '',
        description: config.oldDescription || '',
        age_range: config.oldAgeRange || '',
        duration_per_session: config.oldDurationPerSession || '',
        category: config.oldCategory || '',
        course_type_id: config.oldCourseTypeId || '',
        image: config.oldImage || '',
    },

    openEditModal(module) {
        this.editMode = true;
        this.moduleData = { ...module, image: module.image, category: module.category || '' };
        this.actionUrl = `/modules/${module.id}`;
        this.imagePreview = module.image ? `/storage/${module.image}` : null;
        this.showModuleModal = true;
    },

    openDeleteModal(moduleId) {
        this.actionUrl = `/modules/${moduleId}`;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (config.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showModuleModal = false;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = config.storeRoute;
        this.moduleData = { id: '', name: '', description: '', age_range: '', duration_per_session: '', category: '', course_type_id: '', image: '' };
        this.imagePreview = null;
        this.showModuleModal = true;
    }
});

export const studentManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,
    
    showModuleModal: config.hasErrors,
    showDeleteModal: false,
    editMode: config.oldStudentId ? true : false,
    actionUrl: config.oldStudentId ? `/students/${config.oldStudentId}` : config.storeRoute,

    studentData: { 
        id: config.oldStudentId || '',
        name: config.oldName || '', 
        school: config.oldSchool || '',
        phone_number: config.oldPhoneNumber || '',
        address: config.oldAddress || ''
    },

    init() {
        if (this.studentData.id) {
            this.actionUrl = `/students/${this.studentData.id}`;
        }
    },
    
    openEditModal(student) {
        this.editMode = true;
        this.studentData = { ...student, is_profile_complete: student.is_profile_complete == 1 };
        this.actionUrl = `/students/${student.id}`;
        this.showStudentModal = true;
    },

    openDeleteModal(studentId) {
        this.actionUrl = `/students/${studentId}`;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (this.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showStudentModal = false;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = config.storeRoute;
        this.studentData = { id: '', name: '', school: '', phone_number: '', address: '' };
        this.showStudentModal = true;
    }
});

export const studentProjectManager = (config) => ({
    hasProjectErrors: config.hasProjectErrors,
    hasReviewErrors: config.hasReviewErrors,
    storeRoute: config.storeRoute,
    storeReviewRoute: config.storeReviewRoute,
    bulkDestroyRoute: config.bulkDestroyRoute,
    deleteMode: 'single',
    studentProjectIds: config.studentProjectIds,
    studentProjectCount: config.studentProjectCount,

    showStudentProjectModal: config.hasProjectErrors,
    showReviewModal: config.hasReviewErrors,

    showDeleteProjectModal: false,
    showDeleteReviewModal: false,

    editModeProject: config.oldStudentProjectId ? true : false,
    editModeReview: config.oldReviewId ? true : false, 
    actionUrlProject: config.oldStudentProjectId ? `/student-projects/${config.oldStudentProjectId}` : config.storeRoute,
    actionUrlReview: config.oldReviewId ? `/project-reviews/${config.oldReviewId}` : config.storeReviewRoute,
    mediaPreview: config.oldMedia ? `/storage/${config.oldMedia}` : null,
    mediaUrl: config.mediaUrl,

    studentProjectData: {
        id: config.oldStudentProjectId || '',
        title: config.oldTitle || '',
        description: config.oldDescription || '',
        date: config.oldDate || '',
        media: config.oldMedia || '',
        project_url: config.oldProjectUrl || '',
        is_published: config.oldIsPublished || false,
        module_id: config.oldModuleId || '',
        student_id: config.oldStudentId || '',
    },

    projectReviewData: {
        id: config.oldReviewId || '',
        student_project_id: config.oldReviewStudentProjectId || '',
        rating: Number(config.oldReviewRating) || 0,
        review_content: config.oldReviewContent || '',
        is_approved: config.oldReviewIsApproved ? true : false
    },

    selectedStudentProjects: [],
    get allSelected() {
        return this.selectedStudentProjects.length === this.studentProjectCount && this.studentProjectCount > 0;
    },
    
    toggleAll() {
        if (this.allSelected) {
            this.selectedStudentProjects = [];
        } else {
            this.selectedStudentProjects = [...this.studentProjectIds];
        }
    },

    isVideo(mediaUrl) {
        if (!mediaUrl) return false;
        const ext = String(mediaUrl).split('.').pop().toLowerCase();
        return ['mp4', 'webm', 'ogg'].includes(ext);
    },

    isPdf(mediaUrl) {
        if (!mediaUrl) return false;
        return String(mediaUrl).split('.').pop().toLowerCase() === 'pdf';
    },

    openEditModal(studentProject) {
        this.editModeProject = true;
        let date = studentProject.date ? String(studentProject.date).substring(0, 10) : '';
        this.studentProjectData = { ...studentProject, date: date, media: studentProject.media };
        this.actionUrlProject = `/student-projects/${studentProject.id}`;
        this.mediaPreview = studentProject.media ? `/storage/${studentProject.media}` : null;
        this.showStudentProjectModal = true;
    },

    closeEditModal() {
        if (this.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showStudentProjectModal = false;
            this.mediaPreview = null;
        }
    },  

    resetModal() {
        this.editModeProject = false;
        this.actionUrlProject = this.storeRoute;
        this.studentProjectData = { id: '', title: '', description: '', date: '', media: '', project_url: '', is_published: false, module_id: '', student_id: '' };
        this.mediaPreview = null;
        this.showStudentProjectModal = true;
    },

    openReviewModal(studentProject) {
        if (studentProject.project_review) {
            this.editModeReview = true;
            this.actionUrlReview = `/project-reviews/${studentProject.project_review.id}`;
            this.projectReviewData = {
                id: studentProject.project_review.id,
                student_project_id: studentProject.id,
                rating: studentProject.project_review.rating || 0,
                review_content: studentProject.project_review.review_content || '',
                is_approved: studentProject.project_review.is_approved == 1
            };
        } else {
            this.editModeReview = false;
            this.actionUrlReview = this.storeReviewRoute;
            this.projectReviewData = {
                id: '',
                student_project_id: studentProject.id,
                rating: 0,
                review_content: '',
                is_approved: false
            };
        }
        this.showReviewModal = true;
    },

    closeReviewModal() {
        if (this.hasReviewErrors) {
            window.location.href = window.location.pathname; 
        } else {
            this.showReviewModal = false;
        }
    },

    closeDeleteReviewModal() {
        this.showDeleteReviewModal = false;
        this.showReviewModal = true;
    },

    openDeleteProjectModal(studentProjectId) {
        this.deleteMode = 'single';
        this.actionUrlProject = `/student-projects/${studentProjectId}`;
        this.showDeleteProjectModal = true;
    },

    openBulkDeleteModal() {
        this.deleteMode = 'bulk';
        this.actionUrlProject = this.bulkDestroyRoute;
        this.showDeleteProjectModal = true;
    }
});

export const generalTestimonialManager = (config) => ({
    hasErrors: config.hasErrors,
    storeRoute: config.storeRoute,
    bulkDestroyRoute: config.bulkDestroyRoute,
    testimonialIds: config.testimonialIds,
    testimonialCount: config.testimonialCount,

    showTestimonialModal: config.hasErrors,
    showDeleteModal: false,
    showDetailModal: false,
    deleteMode: 'single',
    editMode: config.oldTestimonialId ? true : false,
    actionUrl: config.oldTestimonialId ? `/general-testimonials/${config.oldTestimonialId}` : config.storeRoute,

    testimonialData: {
        id: config.oldTestimonialId || '',
        parents_name: config.oldParentsName || '',
        review_content: config.oldReviewContent || '',
        is_published: config.oldIsPublished || '',
    },
    
    selectedTestimonials: [],
    get allSelected() {
        return this.selectedTestimonials.length === this.testimonialCount && this.testimonialCount > 0;
    },
    toggleAll() {
        if (this.allSelected) {
            this.selectedTestimonials = [];
        } else {
            this.selectedTestimonials = [...this.testimonialIds]; 
        }
    },

    openEditModal(testimonial) {
        this.editMode = true;
        this.testimonialData = { ...testimonial };
        this.actionUrl = `/general-testimonials/${testimonial.id}`;
        this.showTestimonialModal = true;
    },

    openDeleteModal(testimonialId) {
        this.deleteMode = 'single';
        this.actionUrl = `/general-testimonials/${testimonialId}`;
        this.showDeleteModal = true;
    },

    openBulkDeleteModal() {
        this.deleteMode = 'bulk';
        this.actionUrl = this.bulkDestroyRoute;
        this.showDeleteModal = true;
    },

    closeEditModal() {
        if (this.hasErrors) {
            window.location.href = window.location.href;
        } else {
            this.showTestimonialModal = false;
        }
    },

    resetModal() {
        this.editMode = false;
        this.actionUrl = this.storeRoute;
        this.testimonialData = { id: '', parents_name: '', review_content: '', is_published: false };
        this.showTestimonialModal = true;
    },

    openDetailModal(testimonial) {
        this.testimonialData = { ...testimonial };
        this.showDetailModal = true;
    }
});