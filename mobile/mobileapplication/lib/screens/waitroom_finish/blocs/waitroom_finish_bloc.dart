import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:mobileapplication/responsitory/repository.dart';
import 'package:mobileapplication/responsitory/stream_socket.dart';
import 'package:mobileapplication/screens/waitroom_finish/blocs/waitroom_finish_event.dart';
import 'package:mobileapplication/screens/waitroom_finish/blocs/waitroom_finish_state.dart';

class WaitRoomFinishBloc extends Bloc<WaitRoomFinishEvent, WaitRoomFinishState> {
  final StreamSocket streamSocket;
  final SocketRepository socketRepository;
  final Repository repository;

  WaitRoomFinishBloc(this.streamSocket, this.socketRepository, this.repository)
      : super(const WaitRoomFinishState());

  @override
  Stream<WaitRoomFinishState> mapEventToState(
      WaitRoomFinishEvent event) async* {
    if (event is WaitRoomFinishEventConnected) {
      try {
        final RoomResponse? roomResponse =
            await repository.getRoom(event.idroom);

        await socketRepository.connectWaitFinishRoom(
          event.idroom,
          event.iduser,
        );

        if (roomResponse != null) {
          yield WaitRoomFinishStateSuccess(streamSocket, roomResponse);
        } else {
          yield WaitRoomFinishStateFail();
        }
      } catch (e) {
        yield WaitRoomFinishStateFail();
      }
    }
  }
}
