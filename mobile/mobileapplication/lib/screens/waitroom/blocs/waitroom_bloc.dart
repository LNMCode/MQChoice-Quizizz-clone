import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/models/insert_user_response.dart';
import 'package:mobileapplication/responsitory/repository.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_event.dart';
import 'package:mobileapplication/screens/waitroom/blocs/waitroom_state.dart';

class WaitRoomBloc extends Bloc<WaitRoomEvent, WaitRoomState> {
  final StreamSocket streamSocket;
  final SocketRepository socketRepository;
  final Repository repository;

  WaitRoomBloc(this.streamSocket, this.socketRepository, this.repository)
      : super(WaitRoomStateInitial());

  @override
  Stream<WaitRoomState> mapEventToState(WaitRoomEvent event) async* {
    if (event is WaitRoomEventConnected) {
      try {
        final InsertUserResponse? response = await repository.insertUserToRoom(
            event.idroom, event.iduser, event.nameuser);

        print(response!.message);

        await socketRepository.connectWaitRoom(
            event.idroom, event.iduser, event.nameuser);
        yield WaitRoomSuccess(streamSocket);
      } catch (e) {
        yield WaitRoomStateFail();
      }
    }
  }
}
