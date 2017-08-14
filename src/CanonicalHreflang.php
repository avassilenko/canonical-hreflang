<?php
namespace Crumby\CanonicalHreflang;

/**
 * Description of CanonicalHreflang
 *
 * @author Andrei Vassilenko <avassilenko2@gmail.com>
 */
class CanonicalHreflang {
    protected $allLocales;
    protected $defaultLocales;
    protected $multiLangular;
    
    // 'canonical', 'hreflang'
    protected $links;
   
    public function __construct() {
        $this->links = [
           'canonical' => '',
           'hreflang' => [] 
        ];
        $this->loadConfig();
    }
    
    /**
     * Load configuration from config/canonical-hreflang.php
     */
    public function loadConfig() {
        $this->multiLangular = config('crumby-crumbs.canonical-hreflang.multilangular');
        $this->allLocales = config('app.all_locales');
        $this->defaultLocales = config('app.fallback_locale');
    }
    
    /**
     * If need to use 'hreflang'. It is set in configuration.
     * @return boolen
     */
    public function isMultiLangular() {
        return $this->multiLangular;
    }
    
    /**
     * Returns All avalable locales. It is set in config/app.php 'all_locales' variable.
     * @return array All avalable locales
     */
    public function getAllRoutelocales() {
        return $this->allLocales;
    }
    
    /**
     * Returns All avalable locales. It is set in config/app.php 'fallback_locale' variable.
     * @return string Default locale
     */
    public function getDefaultRoutelocale() {
        return $this->defaultLocales;
    }
    
    /**
     * Test if locale is default
     * @return bool
     */
    public function isDefaultLocale($locale) {
        return $this->defaultLocales === $locale;
    }
    
    /**
     * Set canonical url link
     * @param string $canonical
     */
    public function setCanonical($canonical) {
        $this->links['canonical'] = $canonical;
    }
    
    /**
     * Get canonical url link
     * @param string $canonical
     */
    public function getCanonical() {
        return $this->links['canonical'];
    }   
    
    /**
     * Adds hreflang url to array of links
     * @param string $hrefLang
     */
    public function addHreflang($locale, $hrefLang) {
        $this->links['hreflang'][$locale] = $hrefLang;
    }
    
    /**
     * Get array of hreflang url links
     * @param array 
     */
    public function getHreflang() {
        return $this->links['hreflang'];
    }
    
    /**
     * Builds canonical url and hreflang url data  
     */
    public function addCanonicalHreflang() {
        $this->links['canonical'] = \Routelocale::getLocalizedRoute(null, null, false, true);
        if ($this->isMultiLangular()) {
            $this->links['hreflang'] = \Routelocale::getAllLocalizedRoutes(null, false, true);
        }      
    }
    
    /**
     * Returns html tags with corresponding values
     * @return string
     */
    public function __toString() {
        $links = '';
        $links .= '<link rel="canonical" href="' . $this->getCanonical() . '" />' . "\n";
        if ($this->isMultiLangular()) {
            foreach ($this->getHreflang() as $locale => $hreflang) {
               $links .= '<link rel="alternate" hreflang="' . $locale . '" href="'. $hreflang . '" />' . "\n";
               /*
                * if locale is default - add 'x-default' to links
                */
               if ($this->isDefaultLocale($locale)) {
                   $links .= '<link rel="alternate" hreflang="x-default" href="' . $hreflang . '"  />' . "\n";
               }
            }
            
        }
        return $links;
    }
}
