<?php

namespace Ofey\Logan22\model\config;

use Ofey\Logan22\model\db\sql;

class palette
{
    public string $navLayout = "vertical";
    public string $themeMode = "light";
    public string $headerStyles = "light";
    public string $menuStyles = "light";
    public string $headerPosition = "fixed";
    public string $menuPosition = "fixed";
    public ?string $navStyle = 'detached-close';
    public ?string $bgImg = null;
    public ?string $verticalStyle = 'detached';
    public ?string $toggled = "detached-close";
    public string $pageStyle = "regular";
    public string $width = "fullwidth";
    public string $style = "";


    public function __construct()
    {
        $configData          = sql::getRow(
          "SELECT * FROM `settings` WHERE `key` = '__config_palette__'"
        );
        if($configData){
            $setting             = json_decode($configData['setting'], true, 512);
            $this->navLayout = $setting['nav-layout'] ?? "vertical";
            $this->themeMode = $setting['theme-mode'] ?? "light";
            $this->headerStyles = $setting['header-styles'] ?? "light";
            $this->menuStyles = $setting['menu-styles'] ?? "light";
            $this->headerPosition = $setting['header-position'] ?? "fixed";
            $this->menuPosition = $setting['menu-position'] ?? "fixed";
            $this->navStyle = $setting['nav-style'] ?? 'detached-close';
            $this->bgImg = $setting['bg-img'] ?? null;
            $this->verticalStyle = $setting['vertical-style'] ?? 'detached';
            $this->toggled = $setting['toggled'] ?? "detached-close";
            $this->pageStyle = $setting['page-style'] ?? "regular";
            $this->width = $setting['width'] ?? "fullwidth";
            $this->style = $setting['style'] ?? "";
         }
    }

    public function getAll(): array
    {
        return [
            'data-nav-layout' => $this->navLayout,
            'data-theme-mode' => $this->themeMode,
            'data-header-styles' => $this->headerStyles,
            'data-menu-styles' => $this->menuStyles,
            'data-header-position' => $this->headerPosition,
            'data-menu-position' => $this->menuPosition,
            'data-nav-style' => $this->navStyle,
            'data-bg-img' => $this->bgImg,
//            'data-vertical-style' => $this->verticalStyle,
            'data-toggled' => $this->toggled,
            'data-page-style' => $this->pageStyle,
            'data-width' => $this->width,
            'style' => $this->style,
        ];
    }

    public function getStyle(): string
    {
        return $this->style;
    }


    public function getNavStyle(): ?string
    {
        return $this->navStyle;
    }

    public function getNavLayout(): string
    {
        return $this->navLayout;
    }

    public function getThemeMode(): string
    {
        return $this->themeMode;
    }

    public function getHeaderStyles(): string
    {
        return $this->headerStyles;
    }

    public function getMenuStyles(): string
    {
        return $this->menuStyles;
    }

    public function getHeaderPosition(): string
    {
        return $this->headerPosition;
    }

    public function getMenuPosition(): string
    {
        return $this->menuPosition;
    }

    public function getBgImg(): string
    {
        return $this->bgImg;
    }

    public function getVerticalStyle(): string
    {
        return $this->verticalStyle;
    }

    public function getToggled(): string
    {
        return $this->toggled;
    }

    public function getPageStyle(): string
    {
        return $this->pageStyle;
    }

    public function getWidth(): string
    {
        return $this->width;
    }




}