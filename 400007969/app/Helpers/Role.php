<?php

namespace App\Helpers;

enum Role: string {
	case ResearchGroupManager = 'researchgroupmanager';
	case ResearchStudyManager = 'researchstudymanager';
	case Researcher = 'researcher';
}
