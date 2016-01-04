<?php


/** ClassLoader Class
 * @author RAFINA DANY <danyrafina@gmail.com>
 * @deprecated Use Autoloader instead
 * This class enables to load all files
 */

Class ClassLoader {

	static private $resultFileLoader = 0;

	static public function fileLoader($argumentDirectory){

		switch ($argumentDirectory){

			case "INCLUDES":

				try {

					require_once(realpath(dirname(__FILE__)) . '/CONTROLLER/INCLUDES/UtilityFunctions.php');

					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/SimpleUser.php');

					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Smartphone.php');

					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Developer.php');

				} catch (LoadingError $e) {

					

					throw new LoadingError("Erreur de chargement de fichier");

				}

				return self::$resultFileLoader = 1;

				break;

			case "CONTROLLER":

				try {

					require_once(realpath(dirname(__FILE__)) . '/CONTROLLER/Controller.php');

				} catch (LoadingError $e) {



					throw new LoadingError("Erreur de chargement de la base de l'application");

				}

				return self::$resultFileLoader  = 1;

				break;

			case "SMARTPHONECONTENT" :

				try {

					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Screen.php');

					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Processor.php');
					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Os.php');
					require_once(realpath(dirname(__FILE__)) . '/ENTITIES/GPU.php');
					require_once(realpath(dirname(__FILE__)) . '/MODEL/MDA.php');

				} catch (LoadingError $e) {

				

					throw new LoadingError("Erreur de chargement des composants du smartphone");

				}

				return self::$resultFileLoader  = 1;

				break;

				case "ENTITIES":

					try {

						require_once(realpath(dirname(__FILE__)) . '/ENTITIES/SimpleUser.php');

						require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Smartphone.php');

						require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Developer.php');

						require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Screen.php');

						require_once(realpath(dirname(__FILE__)) . '/ENTITIES/Processor.php');
						require_once(realpath(dirname(__FILE__)) . '/ENTITIES/GPU.php');

					} catch (LoadingError $e) {

							

						throw new LoadingError("Erreur de chargement de fichier");

					}

					return self::$resultFileLoader = 1;

					break;

			case "MODEL":

				try {

					require_once(realpath(dirname(__FILE__)) . '/MODEL/MDA.php');

				} catch (LoadingError $e) {



					throw new LoadingError("Erreur de chargement de la base de l'application");

				}

				return self::$resultFileLoader  = 1;

				break;
                        case 'SM_COMPONENT':
                            try {
                                require_once 'S_ENGINE_COMPARATOR/Components/BatteryComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/DimensComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/GPUComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/OsComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/PhotoComponentComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/ProcessorComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/RAMComponentComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/ScreenComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/StorageComponentComparator.php';
                                require_once 'S_ENGINE_COMPARATOR/Components/VideoComponentComparator.php';
                            } catch (Exception $exc) {
                                throw new LoadingError("Erreur de chargement des fichiers nécéssaires au moteur de comparaison : ".$exc->getMessage());
                           }


                        default:

					return self::$resultFileLoader  ;
                                    

							

		}

	}

}