<?php

declare(strict_types=1);

/**
 * ExperienceController — Handles public Experiences Page logic and view rendering.
 */
class ExperienceController
{
    private ExperienceBLL $experienceBLL;

    public function __construct()
    {
        $pdo                  = Database::getConnection();
        $this->experienceBLL = new ExperienceBLL(new ExperienceDAL($pdo));
    }

    /**
     * Display the public Experiences Page.
     */
    public function index(): void
    {
        $selectedCategory      = isset($_GET['category']) ? sanitize($_GET['category']) : 'all';
        $featuredExperience    = $this->experienceBLL->getFeaturedExperience();
        $experiences           = $this->experienceBLL->getExperiences($selectedCategory);
        $experiencesByCategory = $this->experienceBLL->getExperiencesByCategory();
        $categories            = $this->experienceBLL->getCategories();

        // Build WhatsApp enquiry URLs for experiences
        $whatsAppService = new WhatsAppService();
        $generalEnquiryUrl = $whatsAppService->generateGeneralUrl('Hello Serona Hotel & Resort, I would like to enquire about your resort experiences.');

        $data = [
            'page_title'             => 'Experiences — ' . APP_NAME . ' | Nature\'s Embrace',
            'meta_description'       => 'Discover immersive eco-luxury experiences at Serona Hotel & Resort: guided nature walks, rainforest pool leisure, wellness, private jungle dining, and family moments.',
            'active_page'            => 'experiences',
            'selected_category'      => $selectedCategory,
            'featured_experience'    => $featuredExperience,
            'experiences'            => $experiences,
            'experiences_by_category'=> $experiencesByCategory,
            'categories'             => $categories,
            'general_whatsapp_url'   => $generalEnquiryUrl,
        ];

        $this->render('public/experiences', $data);
    }

    /**
     * Render a view file, passing extracted data variables.
     *
     * @param string $view  Relative path from /views/ (no .php extension).
     * @param array  $data  Variables to extract into the view scope.
     */
    private function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEWS_PATH . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view) . '.php';
    }
}
